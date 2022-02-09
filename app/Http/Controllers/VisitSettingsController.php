<?php

namespace App\Http\Controllers;
use App\VisitSetting;
use App\Project;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
class VisitSettingsController extends Controller
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
            $projects = Project::with('visits')->paginate(10);

            return view('visits.index', compact('projects'));
        }

         return view('auth.login');
    }

    public function visitsDatatable()
    {
        if (Auth::check()){
            return Datatables::of(VisitSetting::query()->with('project'))
            
            ->addColumn('editLink', function ($row) {
                return '<a href="/visits/'.$row->id.'/edit">'."Edit".'</a>';
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

            $project = Project::all();
            return view('visits.create',compact('project'));
        }
        return view('auth.login');
    }

    public function createForProject($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('visits.createForProject', compact('project'));
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

            $exist = VisitSetting::where('visit_name',$request->input('visit_name'))
            ->Where('project_id', $request->input('project_id'))
            ->count();

            if($exist > 0){
                return back()->withinput()->with('errors2','Error Occured, This Visit exist in the selected project, Please check your Entry and Try again, or Contact IT team for help');
            }else{

            $visit=VisitSetting::create([
                                    'project_id'=>$request->input('project_id'),
                                    'visit_name'=>$request->input('visit_name'),
                                    'number_of_days'=>$request->input('number_of_days'),
                                    'window_period'=>$request->input('window_period'),
                                    'updated_by'=>auth::user()->email
                                 ]);
        if ($visit){
            return redirect()->route('visits.index')->with('success','Information have been saved Successfully.');
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
    public function edit(VisitSetting $visit)
    {
        //
        if (Auth::check()){
            $project = Project::all();
            $visit  = VisitSetting::find($visit->id);
        return view('visits.edit',compact('visit', 'project'));
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
    public function update(Request $request, VisitSetting $visit)
    {
        if (Auth::check()){

        $visit=VisitSetting::where('id', $visit->id)
                              ->update([
                                'number_of_days'=>$request->input('number_of_days'),
                                'window_period'=>$request->input('window_period'),
                                'updated_by'=>auth::user()->email
                                       ]);
if ($visit){

    return redirect()->route('visits.index')->with('success','Information have been saved Successfully.');
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
        $deletedRows = VisitSetting::where('id', $id)->delete();
        return redirect()->route('visits.index')->with('success','Information have been Deleted Successfully.');
 
    }
}
