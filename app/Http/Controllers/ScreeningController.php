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

        return redirect()->route('home')->with('success','Screening Information added Successfully!');
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
