<?php

namespace App\Http\Controllers;
use App\Project;
use App\Models\User;
use App\Department;
use App\UserProject;
use App\Models\Site;
use App\Models\ProjectSite;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
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

    public function alpineTest()
    {
        $users = User::all();
        $sites = Site::all();

        return view('alpineTest2', compact('users', 'sites'));
    }

    public function livewireTest()
    {

        return view('livewireTest');
    }

    public function index(Request $request)
    {
        if (Auth::check())
        {
            $allProjects = Project::paginate(10);

            return view('projects.index', compact('allProjects'));
        }

        return view('auth.login');
    }

    public function projectListdt()
    {
        if (Auth::check()){
            return Datatables::of(UserProject::with('project')->where('user_id',auth::user()->id)->orderBy('project_id'))
            ->addColumn('editLink', function ($row) {
                return '<a href="/projectData/'.$row->project_id.'">'."View Data".'</a>';
            })
            ->rawColumns(['editLink'])
            ->make(true);
        
    }
    return view('auth.login');
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $sites = Site::all();
        
        return view('projects.create', compact('users', 'sites'));
        
    }

    public function store(StoreProjectRequest $request)
    {
        $this->projectService->checkIfDuplicateProjectNameExists($request->name);

        $request->screening_visit_labels = $this->projectService->formatScreeningVisitLabels($request->screening_visit_labels);

        $newProject = Project::create($request->validated());

        $newProject->assignManagers($request->managers);
        $newProject->assignSites($request->sites);

        return redirect()->route('projects.index')->with('success','Project Information has been saved Successfully.');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if (Auth::check()){
            $projects  = Project::with('pi')->with('pis')->with('dept')->find($project->id);
            $user = User::all();
            $department = Department::all();
             return view('projects.edit',compact('projects','user','department'));
             }
             return view('auth.login');
    }


    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        if (Auth::check()){

        $projects=Project::where('id', $project->id)
                              ->update([
                                'name'=>$request->input('name'),
                                'description'=>$request->input('description'),
                                'updated_by'=>auth::user()->email,
                                       ]);

if ($projects){

    return back()->withinput()->with('success','Information have been saved Successfully.');
}

        //redirect
       // return back()->withinput();
       return back()->withinput()->with('errors','Error Updating');
    }
    return view('auth.login');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
