<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
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
        $this->middleware('auth');
        $this->service = $service;
    }

    public function enrolmentIndex()
    {
        $projectsWithVisits = Project::whereHas('visits')->whereAssignedTo(auth()->id())
                                        ->paginate(10);

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

        $assignedSites = Auth::user()->sites()->whereHasProject($projectId)->get();

        $screenedParticipants = Screening::where('project_id', $projectId)
                                ->whereSiteAssignedTo(auth()->id())
                                ->where('screening_outcome', 'LIKE', 'Enrol')
                                ->get()
                                ->unique('participant_id')
                                ->pluck('participant_id');

        return view('participantVisits.createParticipant', compact('project', 'firstProjectVisitName', 'screenedParticipants', 'assignedSites'));
    }

    public function storeParticipant($projectId, StoreParticipantRequest $request)
    {
        $data = $request->validated();

        $participantAlreadyEnrolled = $this->service->participantIsEnrolledInProject($request->participant_id, $projectId);
        if($participantAlreadyEnrolled)
        {
            return back()->withInput()->with('error_message', 'Sorry this participant has already been enrolled in this study');
        }

        $participantVisitSchedule = $this->service->generateParticipantVisitSchedule($data, $projectId);

        ParticipantVisit::insert($participantVisitSchedule);
        
        return redirect()->route('participantVisits.enrolmentIndex')->with('success','Participant Visit schedule information saved successfully!');
    }

}
