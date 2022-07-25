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
        $projectsWithScreening = Project::whereAssignedTo(auth()->id())
                                ->where('include_screening', 'LIKE', 'Yes')
                                ->paginate(7);

        return view('screening.index', compact('projectsWithScreening'));
    }

    public function viewScreenings($projectId)
    {
        return view('screening.viewScreenings', compact('projectId'));
    }

    public function screenPatientForm(Project $project)
    {
        $assignedSites = Auth::user()->sites()->get();
        $screeningLabels = $this->service->getScreeningLabels($project->id);
        $returningParticipants = $this->service->getReturningParticipantIds($project->id);

        return view('screening.create', compact('project', 'assignedSites', 'screeningLabels', 'returningParticipants'));
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

        return redirect()->route('screening.screenPatientForm', $data['project_id'])->with('success','Screening Information added Successfully!');
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
