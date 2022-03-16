<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Department;
use App\UserProject;
use App\Project;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::withCount('projects')->paginate(10);
           
        return view('users.index');
    }

    public function userDatatable()
    {
        //$data = User::select('*');
            return Datatables::of(User::query())
                    ->addColumn('editLink', function ($row) {
                        return '<a href="/user/'.$row->id.'/edit">'."Edit".'</a>';
                    })
                    ->rawColumns(['editLink'])
                    ->make(true);    
        }

        public function edit(User $user)
        {
            if (Auth::check()){

            $projects = Project::all();
            $User  = User::find($user->id);
            $roles = Role::get();
            $userRole = $User->roles->pluck('name','name')->all();
            $departments = Department::where('id','!=',0)->get();
            $userProjects = UserProject::where('user_id',$user->id)->with('project')->get();
            return view('users.edit',compact('User', 'departments', 'userRole','roles','projects','userProjects'));

    }
        return view('auth.login');
    }

    public function update(Request $request, User $User)
    {
        if (Auth::check()){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'department' => 'required|string',
            'username' => 'required|string',
            ]);

        $user=User::where('id', $User->id)
                ->update([
                    'email'=>$request->input('email'),
                    'name'=>$request->input('name'),
                    'username'=>$request->input('username'),
                    'user_active'=>$request->input('user_active'),
                    'department'=>$request->input('department'),
                    'user_active'=>$request->input('user_active'),
                    'updated_by'=>auth::user()->email
                        ]);

        //Update the User's role
        $updatedUser = User::find($User->id);
        DB::table('model_has_roles')->where('model_id',$User->id)->delete();
        $updateRoles = $updatedUser->assignRole($request->input('roles'));
if ($user){
    return redirect()->route('user.index')->with('success','Information Updated Successfully');
}

        //redirect
       // return back()->withinput();
       return back()->withinput()->with('errors','Error Updating');
}
    
    return view('auth.login');
}

public function create()
    {
       $departments = Department::where('id','!=',0)->get();
        return view('users.create')->with('departments', $departments);
    }



    public function store(Request $request)
    {

         if (Auth::check()){
//
            $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'username' => 'required|string',
                ]);

                $exist = User::where('email', $request->input('email'))
                ->orWhere('username', $request->input('username'))
                ->count();
                if($exist > 0){
                    return back()->withinput()->with('errors2','Error Occured, This user exist, Please check in the database and Edit if necessary');
                }


           $addusers=User::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'username'=>$request->input('username'),
            'user_active'=>$request->input('user_active'),
            'updated_by'=>auth::user()->email
                     ]);

                     if($addusers){
        return redirect()->route('user.index')->with('success','Information have been saved Successfully, Now fill the staff address here.');;

        }else{
            return back()->withinput()->with('errors','Error Occured, Probably this user exist');

    }
}


}


public function addprojecttouser(Request $request)
    {
        //
        if (Auth::check()){
           if(Auth::user()->hasRole('super admin') ){

            $exist = UserProject::where('user_id', $request->input('user_id'))
           ->Where('project_id', $request->input('project_id'))
            ->count();
            if($exist > 0){
                return back()->withinput()->with('errors2','Error Occured, This Information exist, Please check in the database and Edit if necessary');
            }

             $addproject=UserProject::create([
            'user_id'=>$request->input('user_id'),
            'project_id'=>$request->input('project_id')
            ]);
            if($addproject){
                return back()->withinput()->with('success','Information have been saved Successfully.');;
}else{
   return back()->withinput()->with('errors','Error Occured, Probably this user exist');
}
        }
        return redirect()->route('home'); 
    }
        return view('auth.login');
    }


    public function removeprojecttouser(Request $request)
    {
        if (Auth::check()){
            if(Auth::user()->hasRole('super admin') ){
        \DB::table('user_projects')->where('user_id', $request->input('user_id'))
        ->where('project_id', $request->input('project_id'))
        ->delete();
        return back()->withinput()->with('success','Information have been Deleted Successfully.');
    }
    return redirect()->route('home'); 
}
    return view('auth.login');
}
}
