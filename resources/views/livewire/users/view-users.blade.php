
<div class="card col-md-12">
    <div class="card-header">
        <h4 class="card-title"><button wire:click.prevent='create' class="btn btn-sm btn-primary mr-5"> <i class="fa fa-plus-circle"> </i> Add New User </button> </h4> 

        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 250px;">
                <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Active</th>
                    <th>No. of Projects</th>
                    <th>Updated by</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->user_active }}</td>
                    <td>{{ $user->projects_count }}</td>
                    <td>{{ $user->updated_by }}</td>
                    <td><a class="btn btn-sm btn-warning" wire:click='edit({{ $user }})'> <i class="fa fa-edit"></i> Edit</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">No Result Found... </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
        {!! $users->links() !!}
        </div>
        
    </div>

    <!-- Add Form Modal -->
    <div wire:ignore.self class="modal fade" id="createUserForm" tabindex="-1" role="dialog" aria-labelledby="createUserFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form wire:submit.prevent="saveUser">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserFormLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" wire:model.defer="create_form_state.name" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter user's full name">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" wire:model.defer="create_form_state.username" class="form-control @error('username') is-invalid @enderror"  placeholder="Enter username">
                    @error('username')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" wire:model.defer="create_form_state.email" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter email">
                    @error('email')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" wire:model.defer="create_form_state.password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" wire:model.defer="create_form_state.password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </div>
        </form>
        </div>
    </div>

    <!-- Edit Form Modal -->
    <div wire:ignore.self class="modal fade" id="editUserForm" tabindex="-1" role="dialog" aria-labelledby="editUserFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="updateUser">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserFormLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" wire:model.defer="edit_form_state.name" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter user's full name">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" wire:model.defer="edit_form_state.username" class="form-control @error('username') is-invalid @enderror"  placeholder="Enter username">
                    @error('username')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" wire:model.defer="edit_form_state.email" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter email">
                    @error('email')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">User Active?</label>
                    <select wire:model.defer="edit_form_state.user_active" class="form-control form-select @error('user_active') is-invalid @enderror">
                        <option selected disabled> </option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    @error('user_active')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" wire:model.defer="edit_form_state.password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" wire:model.defer="edit_form_state.password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </div>
            </form>
        </div>
    </div>
</div>


