<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitSettings\StoreVisitsForProjectsRequest;
use App\Models\VisitSetting;
use App\Project;
use App\Services\VisitSettingsService;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitSettingsController extends Controller
{
    protected $service;

    public function __construct(VisitSettingsService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $projects = Project::whereAssignedTo(Auth::id())->with('visits')->paginate(10);

        return view('visits.index', compact('projects'));
    }

    public function create(Project $project)
    {
        return view('visits.create', compact('project'));
    }

    public function createForProject($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('visits.createForProject', compact('project'));
    }

    public function storeVisitsForProject($projectId, StoreVisitsForProjectsRequest $request)
    {
        $data = $request->validated();
        $project = Project::findOrFail($projectId);

        $this->service->checkIfProjectHasVisits($project);

        $firstVisitData = $this->service->makeFirstVisitAttributes($project, $data['visit_1_label']);
        VisitSetting::create($firstVisitData);
        
        $otherVisits = $this->service->makeVisitsArray($data);
        $this->service->massCreate($project, $otherVisits);
        
        return redirect()->route('visits.index')->with('success','The visits have been added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    
    
}
