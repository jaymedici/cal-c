@extends('adminlte::page')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.users-multiple').select2();
    });
</script>
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card card-info">
            <div class="card-header with-border row">
                <div class="col-md-8">
                    <h4 class="box-title">Sites</h4>
                </div>

                <div class="col-md-4">
                    <a class="float-right btn btn-success " href="/sites/create"><i class="fas fa-plus-circle"></i> Register New Site</a>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="card-body" style="">
                
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Site Name</th>
                                <th>District</th>
                                <th>Region</th>
                                <th>Country</th>
                                <th>Site Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($allSites as $site)
                            <tr>
                                <td>{{$site->site_name}}</td>
                                <td>{{$site->district}}</td>
                                <td>{{$site->region}}</td>
                                <td>{{$site->country}}</td>
                                <td>{{$site->users_count}}</td>
                                <td><a class="btn btn-info btn-sm" data-toggle="modal" data-target="#SiteUsersModal{{$site->id}}">Add Users</a></td>
                                
                                <!-- Add Users to Site Modal -->
                                <div class="modal fade" id="SiteUsersModal{{$site->id}}" tabindex="-1" role="dialog">
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$allSites->links()}}
                </div>
                <!-- /.table-responsive -->

            </div>
        </div>
    </div>
</div>
@endsection
