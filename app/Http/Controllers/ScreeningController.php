<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Project;
use Illuminate\Http\Request;
use Auth;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
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
        $projectsWithScreening = Project::where('include_screening', 'LIKE', 'Yes')->get();

        return view('screening.create', compact('projectsWithScreening'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'project_id' => 'required',
            'screening_label' => 'required',
            'screening_date' => 'required',
            'screening_outcome' => 'required',
            'participant_type' => 'required',
            'participant_id' => 'required_if:participant_type,==,New',
            'participant_id_select' => 'required_if:participant_type,==,Returning',
            'next_screening_date' => 'required_if:screening_outcome,==,Continue Screening',
        ];

        $data = $request->validate($rules);

        //Check that no two new participants are assigned with the same participant_id
        if($data['participant_type'] == "New")
        {
            $participant = Screening::where('participant_id', $data['participant_id'])
                                            ->where('project_id', $data['project_id'])
                                            ->count();

            if($participant > 0)
            {
                return back()->with('error_message', 'Sorry! a participant with this participant id already exists, hence participant type cannot be New!');
            }
        }

        if($data['participant_type'] == "New")
        {
            $data['participant_id'] = $request->input('participant_id');
        }
        elseif($data['participant_type'] == "Returning")
        {
            $data['participant_id'] = $request->input('participant_id_select');
        }

        if($data['screening_outcome'] == "Continue Screening")
        {
            $data['next_screening_date'] = $request->input('next_screening_date');
            $data['still_screening'] = "Yes";
        }
        else
        {
            $data['next_screening_date'] = null;
            $data['still_screening'] = "No";
        }
        $data['updated_by'] = Auth::user()->email;

        try{
            Screening::create($data);
        }
        catch(\Exception $exception)
        {
            dd($exception);
            return back()->withinput()->with('error_message','An Error Occured while saving data');
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
