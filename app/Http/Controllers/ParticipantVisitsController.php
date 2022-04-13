<?php

namespace App\Http\Controllers;

use App\Models\ParticipantVisit;
use Illuminate\Http\Request;
use App\Project;
use App\Models\VisitSetting;
use App\Models\Screening;
use App\Services\ParticipantVisitsService;
use Auth;

class ParticipantVisitsController extends Controller
{
    protected $service;

    public function __construct(ParticipantVisitsService $service)
    {
        $this->service = $service;
    }

    public function enrolmentIndex()
    {
        $projectsWithVisits = Project::whereHas('visits')->paginate(10);

        return view('participantVisits.enrolmentIndex', compact('projectsWithVisits'));
    }

    public function projectVisitsIndex($projectId)
    {

        return view('participantVisits.projectVisitsIndex', compact('projectId'));
    }

    public function projectMissedVisitsIndex($projectId)
    {
        $missedVisits = ParticipantVisit::where('project_id', $projectId)
                                        ->where('visit_status', 'LIKE', 'Missed')
                                        ->paginate(15);

        return view('participantVisits.projectMissedVisitsIndex', compact('missedVisits'));
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
