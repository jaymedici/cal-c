<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ParticipantVisit;
use Illuminate\Http\Request;
use App\Project;
use App\Models\VisitSetting;
use App\Models\Screening;
use Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class ParticipantVisitsController extends Controller
{
    
    public function get2WeeksScheduledVisits($userId)
    {
        $now = Carbon::now();
        $datetoday = Carbon::createFromFormat('Y-m-d H:s:i', $now);
        $timeInterval = \Carbon\CarbonInterval::weeks(2);
        $dateAfterTwoWeeks = $now->add($timeInterval)->toDateTimeString();

        $participantVisits = ParticipantVisit::with('project')->with('appointment')
                                ->whereProjectAssignedTo($userId)
                                ->whereBetween('window_start_date', [$datetoday, $dateAfterTwoWeeks])
                                ->orderBy('window_start_date', 'asc')
                                ->paginate(5);

        return $participantVisits;
    }

    public function getAllScheduledVisits($userId)
    {
        $participantVisits = ParticipantVisit::with('project')->whereProjectAssignedTo($userId)->get();

        return $participantVisits;
    }

    public function enrolmentIndex()
    {
        $projectsWithVisits = Project::whereHas('visits')->paginate(10);

        return view('participantVisits.enrolmentIndex', compact('projectsWithVisits'));
    }

    public function visitsIndex()
    {
        $projectsWithVisits = Project::whereHas('participantVisits')
                                        ->withCount('visits')
                                        ->paginate(10);

        return view('participantVisits.visitsIndex', compact('projectsWithVisits'));
    }

    public function missedVisitsIndex()
    {
        $projects = Project::isAssigned(auth()->id())->paginate(10);

        return view('participantVisits.missedVisitsIndex', compact('projects'));
    }

    public function projectVisitsIndex($projectId)
    {
        $project = Project::with('visits')->with('participantVisits')->findOrFail($projectId);

        //Get all unique participants
        $participants = ParticipantVisit::where('project_id', $projectId)->get()->unique('participant_id')->pluck('participant_id');

        foreach($participants as $participant)
        { 
            foreach($project->visits as $visit)
            {
                $visitSchedule[$participant][$visit->id] = ParticipantVisit::with('visit')->where('project_id', $projectId)->where('visit_id', $visit->id)
                                ->where('participant_id', 'LIKE', $participant)->first();
            }    
        }

        return view('participantVisits.projectVisitsIndex', compact('project', 'participants', 'visitSchedule'));
    }

    public function projectMissedVisitsIndex($projectId)
    {
        $missedVisits = ParticipantVisit::where('project_id', $projectId)
                                        ->where('visit_status', 'LIKE', 'Missed')
                                        ->paginate(15);

        return view('participantVisits.projectMissedVisitsIndex', compact('missedVisits'));
    }

    public function projectVisitsIndexDT($projectId, Request $request)
    {
        $project = Project::with('visits')->with('participants')->findOrFail($projectId);

        //Get all unique participants
        $participants = ParticipantVisit::where('project_id', $projectId)->get()->unique('participant_id');
        $columns = [ [ 'data' => 'participant_id', 'name' => 'participant_id'] ];

        if($request->ajax())
        {
            $dt = Datatables::of($participants);
            
            foreach($project->visits as $visit)
            {
                $query = ParticipantVisit::where('project_id', $projectId)->where('visit_id', $visit->id)
                ->first();

                $dt->addColumn('window_start_date_' . $visit->id, $query->window_start_date);
                $dt->addColumn('visit_date_' . $visit->id, $query->visit_date);
                $dt->addColumn('actual_visit_date_' . $visit->id, $query->actual_visit_date);
                $dt->addColumn('window_end_date_' . $visit->id, $query->window_end_date);
            }

            return $dt->make(true);
        }

        else
        {
            
            foreach($project->visits as $visit)
            {
                $columns[] = [ 'data' => 'window_start_date_' . $visit->id, 'name' => 'window_start_date_' . $visit->id];
                $columns[] = [ 'data' => 'visit_date_' . $visit->id, 'name' => 'visit_date_' . $visit->id];
                $columns[] = [ 'data' => 'actual_visit_date_' . $visit->id, 'name' => 'actual_visit_date_' . $visit->id];
                $columns[] = [ 'data' => 'window_end_date_' . $visit->id, 'name' => 'window_end_date_' . $visit->id];
            }

            return view('participantVisits.projectVisitsIndexDT', compact('project', 'columns'));
        }
    
    }


    public function createParticipant($projectId)
    {
        $project = Project::with('sites')->findOrFail($projectId);

        $firstProjectVisitName = VisitSetting::where('project_id', $projectId)
                                        ->where('days_from_first_visit', 0)
                                        ->first()
                                        ->visit_name;

        $screenedParticipants = Screening::where('project_id', $projectId)->where('screening_outcome', 'LIKE', 'Enrol')->get()->unique('participant_id')->pluck('participant_id');

        return view('participantVisits.createParticipant', compact('project', 'firstProjectVisitName', 'screenedParticipants'));
    }

    public function storeParticipant($projectId, Request $request)
    {
        //
        $rules = [
            'participant_id' => 'required',
            'site_id' => 'required',
            'first_visit_date' => 'required',
        ];

        $data = $request->validate($rules);
       // dd($data);

        //Check if the Participant is already enrolled
        $participant = ParticipantVisit::where('participant_id', $data['participant_id'])
                                        ->where('project_id', $projectId)
                                        ->count();

        if($participant > 0)
        {
            return back()->with('error_message', 'Sorry this participant has already been enrolled in this study');
        }

        //Get Project Study Visits
        $projectStudyVisits = VisitSetting::where('project_id', $projectId)->get();

        //Generate a visit schedule for the Participant
        foreach($projectStudyVisits as $visit)
        {
            $data['project_id'] = $projectId;
            $data['visit_id'] = $visit->id;
            $data['visit_date'] = date('Y-m-d', strtotime($data['first_visit_date'] . ' + ' . $visit->days_from_first_visit . ' days'));
            $data['window_start_date'] = date('Y-m-d', strtotime($data['visit_date'] . ' - ' . $visit->minus_window_period . ' days'));
            $data['window_end_date'] = date('Y-m-d', strtotime($data['visit_date'] . ' + ' . $visit->plus_window_period . ' days'));
            $data['updated_by'] = Auth::user()->username;
            //Handle First Visit record
            if($visit->days_from_first_visit == 0){
                $data['visit_status'] = "Completed";
                $data['actual_visit_date'] = $data['visit_date'];
            }
            else {
                $data['visit_status'] = "Pending";
                $data['actual_visit_date'] = null;
            }   

            try {
                ParticipantVisit::create($data);
            }
            catch(\Exception $exception)
            {
                return back()->with('error_message', 'Error! One or More Participant visit schedule records could not be created');
            }
        }

        //Return with Success Message
        return redirect()->route('participantVisits.enrolmentIndex')->with('success','Participant Visit schedule information saved successfully!');
    }

}
