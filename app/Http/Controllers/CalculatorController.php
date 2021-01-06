<?php

namespace App\Http\Controllers;
use App\Calendar;
use App\VisitSetting;
use App\Project;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()){
            return view('visitcalculator.index');
    }
    return view('auth.login');
    }

    public function calculatorsDatatable()
    {
        if (Auth::check()){
            return Datatables::of(Calendar::query()->orderBy('project_id')
            ->with('project')
            ->orderBy('visit'))
            ->addColumn('editLink', function ($row) {
                return '<a href="/calculators/'.$row->id.'/edit">'."Edit".'</a>';
            })
            ->rawColumns(['editLink'])
            ->make(true);
        
    }
    return view('auth.login');
    }


    public function passedvisits(Request $request)
    {
        if (Auth::check()){
            return view('visitcalculator.passedvisits');
    }
    return view('auth.login');
    }

    public function passedvisitsDatatable()
    {
        if (Auth::check()){
            return Datatables::of(Calendar::where('visit_status','Completed')
            ->with('project')
            ->orderBy('project_id')->orderBy('visit'))
            
            ->addColumn('editLink', function ($row) {
                return '<a href="/calculators/'.$row->id.'/edit">'."Edit".'</a>';
            })
            ->rawColumns(['editLink'])
            ->make(true);
        
    }
    return view('auth.login');
    }



    public function todayVisits(Request $request)
    {
        if (Auth::check()){
           return view('visitcalculator.todayVisits');
    }
    return view('auth.login');
    }

    public function todayVisitsDatatable()
    {
        if (Auth::check()){
            $todaydate=date("Y-m-d");
            return Datatables::of(Calendar::where('visit_status','Pending and On Window')
            ->where('windows_start_date','<=', $todaydate)
            ->where('windows_end_date','>=', $todaydate)
            ->with('project')
            ->orderBy('project_id')->orderBy('visit'))
            ->addColumn('editLink', function ($row) {
                return '<a href="/calculators/'.$row->id.'/edit">'."Edit".'</a>';
            })
            ->rawColumns(['editLink'])
            ->make(true);
        
    }
    return view('auth.login');
    }

    
    public function missedVisits(Request $request)
    {
        if (Auth::check()){
           return view('visitcalculator.missedVisits');
    }
    return view('auth.login');
    }

    public function missedVisitsDatatable()
    {
        if (Auth::check()){
            $todaydate=date("Y-m-d");
            return Datatables::of(Calendar::where('visit_status','Missed Visit')
            ->where('windows_end_date','<', $todaydate)
            ->with('project')
            ->orderBy('project_id')->orderBy('visit'))
            ->addColumn('editLink', function ($row) {
                return '<a href="/calculators/'.$row->id.'/edit">'."Edit".'</a>';
            })
            ->rawColumns(['editLink'])
            ->make(true);
        
    }
    return view('auth.login');
    }


    public function commingVisits(Request $request)
    {
        if (Auth::check()){
           return view('visitcalculator.commingVisits');
    }
    return view('auth.login');
    }

    public function commingVisitsDatatable()
    {
        if (Auth::check()){
            $todaydate=date("Y-m-d");
            return Datatables::of(Calendar::where('visit_status','Pending')
            ->where('windows_start_date','>', $todaydate)
            ->with('project')
            ->orderBy('project_id')->orderBy('visit'))
            ->addColumn('editLink', function ($row) {
                return '<a href="/calculators/'.$row->id.'/edit">'."Edit".'</a>';
            })
            ->rawColumns(['editLink'])
            ->make(true);
        
    }
    return view('auth.login');
    }


    public function PendingOnWindow()
    {
        if (Auth::check()){
            $todaydate=date("Y-m-d");
            return Datatables::of(Calendar::where('visit_status', 'Pending and On Window')
            ->with('project')
            ->orderBy('project_id')->orderBy('visit'))
            ->addColumn('editLink', function ($row) {
                return '<a href="/calculators/'.$row->id.'/edit">'."Edit".'</a>';
            })
            ->rawColumns(['editLink'])
            ->make(true);
        
    }
    return view('auth.login');
    }


    

    public function projectdt($id)
    {
        if (Auth::check()){
            $todaydate=date("Y-m-d");
            return Datatables::of(Calendar::where('visit_status','Pending and On Window')
            ->where('project_id',$id)
            ->with('project')
            ->orderBy('visit'))
            ->addColumn('editLink', function ($row) {
                return '<a href="/calculators/'.$row->id.'/edit">'."Edit".'</a>';
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
            return view('visitcalculator.create',compact('project'));
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

            $exist = Calendar::where('patient_id',$request->input('patient_id'))
            ->Where('project_id', $request->input('project_id'))
            ->count();

            if($exist > 0){
                return back()->withinput()->with('errors2','Error Occured, This participant ID exist in the selected project, Please check your Entry and Try again, or Contact IT team for help');
            }else{

            $visit = VisitSetting::where('project_id',$request->input('project_id'))->orderBy('id')->get();
            foreach ($visit as $visits) {
            $visitdate= date('Y-m-d', strtotime($request->input('visit_date') . '+'.$visits->number_of_days.'days'));
            $windows_start_date= date('Y-m-d', strtotime($visitdate . '-'.$visits->window_period.'days'));
            $windows_end_date= date('Y-m-d', strtotime($visitdate . '+'.$visits->window_period.'days'));
            if ($visits->number_of_days==0){
                $visit_status= "Completed";
            }
            else{
                $visit_status= "Pending";
            }
            
            $visit=Calendar::create([
                                    'project_id'=>$request->input('project_id'),
                                    'patient_id'=>$request->input('patient_id'),
                                    'site_name'=>$request->input('site_name'),
                                    'visit'=>$visits->visit_name,
                                    'visit_date'=>$visitdate,
                                    'window_period'=>$visits->window_period,
                                    'windows_start_date'=>$windows_start_date,
                                    'windows_end_date'=>$windows_end_date,
                                    'visit_status'=>$visit_status,
                                    'updated_by'=>auth::user()->email
                                 ]);

            }
        if ($visit){
            return redirect()->route('calculators.index')->with('success','Information have been saved Successfully.');
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
    public function edit(Calendar $calculator)
    {
        //
        if (Auth::check()){
            $project = Project::all();
            $visit  = Calendar::find($calculator->id);
        return view('visitcalculator.edit',compact('visit', 'project'));
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
    public function update(Request $request, Calendar $calculator)
    {
        if (Auth::check()){
        $visit=Calendar::where('id', $calculator->id)
                              ->update([
                                'visit_status'=>$request->input('visit_status'),
                                'updated_by'=>auth::user()->email
                                       ]);
if ($visit){

    return redirect()->route('calculators.index')->with('success','Information have been saved Successfully.');
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
        $deletedRows = Calendar::where('patient_id', $id)->delete();
        return redirect()->route('calculators.index')->with('success','Information have been Deleted Successfully.');
    }
}
