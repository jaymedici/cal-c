@extends('adminlte::page')

@section('css')
    <style type="text/css">
        .required::after {
            content: "*";
            color: red;
        }

        .small-text {
            font-size: small;
        }
    </style>

@stop

@section('content')


      @include('partials.errors')
      @include('partials.errors2')
      @include('partials.success')


<div>
   
    <div class="row">
        <div class="card border-info col-md-12 col-lg-12">
            <div class="card-body">

                <div class="row">     

                    <div class="card col-md-6 col-lg-6 mr-5 small-text">
                    <h4 style="text-align:center">Edit User information</h4>
                        <div class="card-body">


                        <form action="{{route('user.update',[$User->id])}}" method="post">
                        {!! csrf_field() !!}

                              <input type="hidden" name="_method" value="put">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Full Name<span class="required"></span></label>
                            <div class="col-md-6">
                                <input id="name" 
                                       type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" 
                                       value="{{$User->name}}" 
                                       required autocomplete="name" 
                                       autofocus >
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">Department<span class="required"></span></label>
                            <div class="col-md-6">
                            <select id="department" required name="department" class="form-control @error('department') is-invalid @enderror"/>
                                  <option value="{{$User->department}}">{{$User->department}}</option>
                                  @foreach($departments as $department)
                                       <option value="{{$department->name}}">{{$department->name}}</option>
                                    @endforeach
                             </select>
                                       @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Address<span class="required"></span></label>
                            <div class="col-md-6">
                                <input id="email" 
                                       type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" 
                                       value="{{$User->email}}" 
                                       required autocomplete="email" 
                                       autofocus >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                  
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">User Name<span class="required"></span></label>
                            <div class="col-md-6">
                                <input id="username" 
                                       type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       name="username" 
                                       value="{{$User->username}}" 
                                       required autocomplete="username" 
                                       autofocus >
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="user_active" class="col-md-4 col-form-label text-md-right">User Active</label>
                            <div class="col-md-6">  
                            
                            <select id="user_active" data-placeholder="Select a Roles" class="form-control tagsselector" name="user_active">  
                                        <option value="{{$User->user_active}}"> {{$User->user_active}}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No"> No</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="userRole" class="col-md-4 col-form-label text-md-right">User Role</label>
                            <div class="col-md-6">  
                            
                            <select id="userRole" data-placeholder="Select a Roles" class="form-control tagsselector" name="roles[]" multiple="multiple">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"  {{ $User->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                                <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10">
                                            <input class="btn btn-success" id="submit" type="submit" value="Save">
                                        </div>
                                </div>
                            </form>
                           
                        </div>
                    </div>


                    <div class="card col-md-5 col-lg-5">
                    <h5 class="card-header">Add Projects</h5>
                   
                        <div class="card-body">

                        <form action="/addprojecttouser" method="get">
                        <input  type="hidden" name="user_id" value="{{$User->id}}">
                        <table class="table">
                                    <thead>
                                    <tr>
                                    <th>  Project Name</th>
                                    <th>
                           <select class="form-control" required name="project_id">
                                <option value="{{ old('project_id') }}">{{ old('staff_id') }}</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                           </select></th>
                           <th>
                           <input class="btn btn-success" id="submit" type="submit" value="Add New Project">
                           </th>
                           </tr></thead> </table>
                                    
                        </form>

                        <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Project ID</th>
                                        <th>Project Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userProjects as $userProject)
                                        <tr>
                                        <td>{{$userProject->project_id}} </td>
                                        <td> {{$userProject->project->name}}</td>
                                        <td>
                                        <form action="/removeprojecttouser" method="get">
                                            <input  type="hidden" name="user_id" value="{{$User->id}}">
                                            <input  type="hidden" name="project_id" value="{{$userProject->project_id}}">
                                            <input onclick='return confirm("Are you sure You want to remove this record?? Click Ok to continue or Click Cancel to Cancel")' class="btn btn-sm btn-danger" id="submit" type="submit" value="Remove">                     
                                        </form>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                            </div>

                        </div> 
                    </div>






                    </div>
                </div>
            </div>
        </div>
   </div>
@stop
