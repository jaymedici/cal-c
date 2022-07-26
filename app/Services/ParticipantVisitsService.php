<?php

namespace App\Services;

use App\Models\ParticipantVisit;
use App\Models\VisitSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ParticipantVisitsService
{
    public static function get2WeeksScheduledVisits($userId)
    {
        $now = Carbon::now();
        $datetoday = Carbon::createFromFormat('Y-m-d H:s:i', $now);
        $timeInterval = \Carbon\CarbonInterval::weeks(2);
        $dateAfterTwoWeeks = $now->add($timeInterval)->toDateTimeString();

        $participantVisits = ParticipantVisit::with('project')->with('appointment')
                                ->with('visit')->with('participant')
                                ->whereProjectAssignedTo($userId)
                                ->whereSiteAssignedTo($userId)
                                ->whereBetween('window_end_date', [$datetoday, $dateAfterTwoWeeks])
                                ->orderBy('window_start_date', 'asc')
                                ->paginate(5);

        return $participantVisits;
    }

    public function scheduledVisitRecords($userId)
    {
        $participantVisits = ParticipantVisit::with('project')->with('appointment')
                                ->with('visit')->with('site')->with('participant')
                                ->whereProjectAssignedTo($userId)
                                ->whereSiteAssignedTo($userId)
                                ->orderBy('visit_date', 'ASC');

        return $participantVisits;
    }

    public static function getAllScheduledVisits($userId)
    {
        $participantVisits = ParticipantVisit::with('project')
                                ->whereProjectAssignedTo($userId)
                                ->whereSiteAssignedTo($userId)
                                ->get();

        return $participantVisits;
    }

    public function participantIsEnrolledInProject($participantId, $projectId)
    {
        $participant = ParticipantVisit::where('participant_id', $participantId)
                                        ->where('project_id', $projectId)
                                        ->count();

        if($participant > 0)
        {
            return true;
        }
    }

    public function generateParticipantVisitSchedule($participantData, $projectId)
    {
        $participantVisitSchedule = array();

        $projectStudyVisits = VisitSetting::where('project_id', $projectId)->get();

        foreach($projectStudyVisits as $visit)
        {
            $participantData['project_id'] = $projectId;
            $participantData['visit_id'] = $visit->id;
            $participantData['visit_date'] = date('Y-m-d', strtotime($participantData['first_visit_date'] . ' + ' . $visit->days_from_first_visit . ' days'));
            $participantData['window_start_date'] = date('Y-m-d', strtotime($participantData['visit_date'] . ' - ' . $visit->minus_window_period . ' days'));
            $participantData['window_end_date'] = date('Y-m-d', strtotime($participantData['visit_date'] . ' + ' . $visit->plus_window_period . ' days'));
            $participantData['created_at'] = Carbon::now()->toDateTimeString();

            if(!array_key_exists('updated_by', $participantData))
            {
                $participantData['updated_by'] = Auth::user()->username;
            }

            //Handle First Visit record
            if($visit->days_from_first_visit == 0 && $participantData['mark_first_visit_complete'] == "Yes")
            {
                $participantData['visit_status'] = "Completed";
                $participantData['actual_visit_date'] = $participantData['visit_date'];
            }
            else {
                $participantData['visit_status'] = "Pending";
                $participantData['actual_visit_date'] = null;
            }

            $participantVisitSchedule[] = $participantData;
        }

        //Unset elements that won't be inserted into the database
        foreach(array_keys($participantVisitSchedule) as $key)
        {
            unset($participantVisitSchedule[$key]['first_visit_date']);
            unset($participantVisitSchedule[$key]['mark_first_visit_complete']);
            unset($participantVisitSchedule[$key]['study_arm_id']);
        }
        
        return $participantVisitSchedule;
    }
}