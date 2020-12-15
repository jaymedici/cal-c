<?php

namespace App\Http\Controllers;
use App\Project;
use App\User;
use App\Department;
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
        if (Auth::check()){
            return view('projects.index');
    }
    return view('auth.login');
    }

    public function projectDatatable()
    {
        if (Auth::check()){
            return Datatables::of(Project::with('pi')->with('dept'))
            ->addColumn('editLink', function ($row) {
                return '<a href="/projects/'.$row->id.'/edit">'."Edit".'</a>';
            })
            ->rawColumns(['editLink'])
            ->make(true);
        
    }
    return view('auth.login');
    }

    public function projectListdt()
    {
        if (Auth::check()){
            return Datatables::of(Project::query())
            ->addColumn('editLink', function ($row) {
                return '<a href="/projectData/'.$row->id.'">'."View Data".'</a>';
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
        if (Auth::check()){
            $user = User::all();
            $department = Department::all();
        return view('projects.create',compact('user','department'));
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

        if (Auth::check()){
            $exist = Project::where('name',$request->input('name'))
            ->count();

            if($exist > 0){
                return back()->withinput()->with('errors2','Error Occured, This Project exist, Please check your Entry and Try again, or Contact IT team for help');
            }else{

            $projects=Project::create([
                                    'name'=>$request->input('name'),
                                    'description'=>$request->input('description'),
                                    'updated_by'=>auth::user()->email
                                 ]);
        if ($projects){
        return redirect()->route('projects.index')->with('success','Information have been saved Successfully.');
        }
           return back()->withinput()->with('errors','Error Updating information');
        }
        return view('auth.login');
    }
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
