<?php

namespace App\Http\Controllers;
use App\Project;
use App\Models\User;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Requests\Projects\StoreProjectRequest;
use App\Services\ProjectService;

class ProjectsController extends Controller
{
    protected $projectService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProjectService $projectService)
    {
        $this->middleware('auth');
        $this->projectService = $projectService;
    }

    public function index(Request $request)
    {
        $allProjects = Project::paginate(10);

        return view('projects.index', compact('allProjects'));
    }

    public function show(Project $project)
    {
        $pageVariables = $this->projectService->getShowPageVariables($project);

        return view('projects.show', compact('project', 'pageVariables'));
    }
   
    public function create()
    {
        $users = User::all();
        $sites = Site::all();
        
        return view('projects.create', compact('users', 'sites'));   
    }

    public function store(StoreProjectRequest $request)
    {
        $this->projectService->checkIfDuplicateProjectNameExists($request->name);

        $request['screening_visit_labels'] = $this->projectService->formatScreeningVisitLabels($request->screening_visit_labels);

        $newProject = Project::create($request->all());

        $newProject->assignManagers($request->managers);
        $newProject->assignSites($request->sites);

        return redirect()->route('projects.index')->with('success','Project Information has been saved Successfully.');
    }
  
}
