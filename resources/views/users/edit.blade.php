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
                                <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10">
                                            <input class="btn btn-success" id="submit" type="submit" value="Save">
                                        </div>
                                </div>
                            </form>
                           
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
   </div>
@stop
