@extends('adminlte::page')
@section('content')

      @include('partials.errors')
      @include('partials.success')

<div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">
<h3 align="center">Register New User </h3>
<!-- Example row of columns -->
<div class="row col-sm-12 col-md-12 col-lg-12" style="background:white; margin: 10px">
            <form action="{{route('user.store')}}" method="post">
                {!! csrf_field() !!}

                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">Users<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-6">
                            <select id="user_id" required name="user_id" class="form-control @error('user_id') is-invalid @enderror"/>
                                  <option value=""></option>
                                  @foreach($users as $user)
                                       <option value="{{$user->id}}">{{$$user->name}}</option>
                                    @endforeach
                             </select>
                                       @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

                   
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Save
                                </button>
                                </div>
                                </div>
            </form>
           
       
    @stop
