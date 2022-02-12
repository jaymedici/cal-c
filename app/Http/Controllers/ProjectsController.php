<?php

namespace App\Http\Controllers;
use App\Project;
use App\User;
use App\Department;
use App\UserProject;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if (Auth::check())
        {
            $users = User::all();
            
            return view('projects.create', compact('users'));
        }

        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check())
        {
            //Validation Rules
            $rules = [
                'name' => 'required',
                'description' => 'required',
                'include_screening' => 'required',
                'managers' => 'required',
                'break_screening' => 'required_if:include_screening,==,Yes',
                'screening_visit_labels.*' => 'required_if:break_screening,==,Yes',
            ];

            //Check if Project already exists
            $project = Project::where('name',$request->input('name'))->count();

            if($project > 0)
            {
                return back()->withinput()->with('errors2','Error Occured, This Project already exists, Please check your Entry and Try again, or Contact IT team for help');
            }
            else
            {
                $data = $request->validate($rules);
                $newProject = new Project();
                $newProject->name = $data['name'];
                $newProject->description = $data['description'];
                $newProject->include_screening = $data['include_screening'];
                $newProject->break_screening = $data['break_screening'];
                $newProject->updated_by = auth::user()->email;
                if($data['break_screening'] == "Yes")
                {
                    $newProject->screening_visit_labels = implode(";", $data['screening_visit_labels']);
                }

                try
                {
                    $newProject->save();
                }
                catch(\Exception $exception)
                {
                    return back()->withinput()->with('error_message','Error Creating Project. If the Error persists please contact IT');
                }
                
                //Get Id of the newly created Project
                $newProjectId = $newProject->id;
                
                //Associate assigned managers to project:
                $managers = $request->input('managers');

                foreach($managers as $key => $manager)
                {
                    try{
                        UserProject::create([
                           'user_id' => $manager,
                           'project_id' => $newProjectId,
                           'project_role' => 'manager',
                           'updated_by' => auth::user()->username,
                           ]);
                    }
                    catch(\Exception $exception)
                    {
                        return back()->withinput()->with('error_message','There was an error assigning one or more of the managers selected');
                    }
                }

                return redirect()->route('projects.index')->with('success','Project Information has been saved Successfully.');
   
            }
        }
        return view('auth.login');
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
