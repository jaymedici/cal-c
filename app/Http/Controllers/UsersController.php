<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Department;
use App\Approver;
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
        //if ($request->ajax()) {
           
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
}
