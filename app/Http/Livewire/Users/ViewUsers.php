<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class ViewUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $showEditModal = false;

    public $user;

    //Form Fields
    public $create_form_state = [];
    public $edit_form_state = [];

    public function create()
    {
        $this->dispatchBrowserEvent('show-create-form');
    }

    public function edit(User $user)
    {
        $this->edit_form_state = $user->toArray();
        //dd($user->toArray());
        $this->user = $user;

        //Add the browser even listener on the main page blade
        $this->dispatchBrowserEvent('show-edit-form');
    }

    public function saveUser()
    {
        //dd($this->create_form_state);
        $data = Validator::make($this->create_form_state, [
                    'name' => 'required',
                    'username' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed|min:6',
                    'password_confirmation' => 'required|same:password'
                    ])
                    ->validate();

        $data['password'] = bcrypt($data['password']);
        $data['user_active'] = "Yes";
        $data['updated_by'] = Auth::user()->username;

        User::create($data);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added Successfully!']);
    }

    public function updateUser()
    {
        //dd($this->edit_form_state);
        $data = Validator::make($this->edit_form_state, [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users,email,'.$this->user->id,
                'user_active' => 'required',
                'password' => 'sometimes|confirmed|min:6',
                'password_confirmation' => 'sometimes|same:password'
                ])
                ->validate();

        if(!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
       
        $data['updated_by'] = Auth::user()->username;

        $this->user->update($data);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated Successfully!']);
    }

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('username', 'like', '%'.$this->search.'%')
                        ->withCount('projects')
                        ->paginate(6);

        return view('livewire.users.view-users', [
            'users' => $users,
        ]);
    }

}
