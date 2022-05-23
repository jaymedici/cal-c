<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Project;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Screening\StoreScreeningRequest;
use App\Services\AppointmentsService;
use App\Services\ScreeningService;

class ScreeningController extends Controller
{
    public $service;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ScreeningService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index()
    {
        return view('screening.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getScreeningTypes($projectId)
    {
        $project = Project::findOrFail($projectId);
        $screeningVisitLabels = array_filter(explode(';', $project->screening_visit_labels));

        if(!empty($screeningVisitLabels))
        {
            return response()->json($screeningVisitLabels);
        }
         
    }

    public function getScreeningReturningParticipants($projectId)
    {
        $allScreenedParticipantIDs = Screening::where('project_id', $projectId)
                                    ->get()->unique('participant_id')
                                    ->pluck('participant_id')
                                    ->toArray();

        $allScreeningInfo = Screening::where('project_id', $projectId)->get();

        foreach($allScreeningInfo as $screening)
        {
            if($screening->screening_outcome == "Enrol" | $screening->screening_outcome == "Screen Failure")
            {
                //remove participant from participant list (to remain only with those whose screening continues)
                $arrayKey = array_search($screening->participant_id, $allScreenedParticipantIDs);
                unset($allScreenedParticipantIDs[$arrayKey]);
            }
        }

        $returningParticipants = $allScreenedParticipantIDs;
        
        return response()->json($returningParticipants);
    }

    public function create()
    {
        //
        $projectsWithScreening = Project::where('include_screening', 'LIKE', 'Yes')
                                        ->whereAssignedTo(auth()->id())
                                        ->get();

        return view('screening.create', compact('projectsWithScreening'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScreeningRequest $request)
    { 
        $data = $request->validated();
        $data['site_id'] = 1;

        if($this->service->duplicatePatientExists($data))
        {
            return back()->with('error_message', 'Sorry! a participant with this participant id already exists, hence participant type cannot be New!');
        }

        $data = $this->service->fillRemainingPatientData($data);

        $screening = Screening::create($data);

        if ($data['screening_outcome'] == "Continue Screening")
        {
            $appointment = new AppointmentsService;
            $appointment->createScreeningAppointment($screening, $data);
        }

        return redirect()->route('screening.create')->with('success','Screening Information added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function show(Screening $screening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function edit(Screening $screening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Screening $screening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Screening $screening)
    {
        //
    }
}
