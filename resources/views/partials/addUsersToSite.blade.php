<div class="modal fade" id="AddUsersModal{{$site->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Users to {{$site->site_name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('site.addUsersToSite', $site->id) }}" method="POST">
                @csrf
            <div class="form-group">
                <div class="row">
                    <label for="users">Select Users to add</label>
                </div>
                <div class="row">
                    <select name="users[]" class="users-multiple" style="width: 100%" multiple>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach 
                    </select>
                    @error('users')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Users</button>
        </div>
            </form>
        </div>
    </div>
    </div>