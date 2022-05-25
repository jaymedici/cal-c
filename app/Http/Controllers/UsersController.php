<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Requests\Users\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    //User Management logic is handled by the ViewUsers Livewire Component

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
    
    public function profileSettings()
    {
        $user = User::findOrFail(auth()->id());

        return view('users.changePassword', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        if(!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }    
        $data['updated_by'] = Auth::user()->username;

        User::findOrFail(auth()->id())->update($data);
        return redirect()->back()->with('success', 'User Info updated successfully!');
    }
}
