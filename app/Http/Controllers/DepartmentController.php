<?php

namespace App\Http\Controllers;
use App\Department;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()){
            return view('departments.index');
    }
    return view('auth.login');
    }

    public function departmentDatatable()
    {
        if (Auth::check()){
            return Datatables::of(Department::query())
            ->addColumn('editLink', function ($row) {
                return '<a href="/departments/'.$row->id.'/edit">'."Edit".'</a>';
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
        return view('departments.create');
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

            $exist = Department::where('name',$request->input('name'))
            ->count();

            if($exist > 0){
                return back()->withinput()->with('errors2','Error Occured, This Project exist, Please check your Entry and Try again, or Contact IT team for help');
            }else{

            $departments=Department::create([
                                    'name'=>$request->input('name'),
                                    'description'=>$request->input('description'),
                                    'updated_by'=>auth::user()->email
                                 ]);
        if ($departments){
        return redirect()->route('departments.index')->with('success','Information have been saved Successfully.');
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
    public function edit(Department $department)
    {
        //
        if (Auth::check()){
       $departments  = Department::find($department->id);
        return view('departments.edit',compact('departments'));
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
    public function update(Request $request, Department $department)
    {
        if (Auth::check()){
        $departments=Department::where('id', $department->id)
                              ->update([
                                'name'=>$request->input('name'),
                                'description'=>$request->input('description'),
                                'updated_by'=>auth::user()->email,
                                       ]);
if ($departments){

    return redirect()->route('departments.index')->with('success','Information have been saved Successfully.');
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
