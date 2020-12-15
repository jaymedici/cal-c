@extends('adminlte::page')
@section('content')

      @include('partials.errors')
      @include('partials.success')

<div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">
<h3 align="center">Create New </h3>
<!-- Example row of columns -->
<div class="row col-sm-12 col-md-12 col-lg-12" style="background:white; margin: 10px">
            <form action="{{route('calculators.store')}}" method="post">
                {!! csrf_field() !!}


                <div class="form-group row">
                            <label for="patient_id" class="col-md-3 col-form-label text-md-right">Participant ID<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="patient_id" 
                                       type="text" 
                                       minlength="1"
                                       class="form-control @error('patient_id') is-invalid @enderror" 
                                       name="patient_id" 
                                       value="" 
                                       required autocomplete="patient_id" 
                                       autofocus >
                                @error('patient_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                <div  class="form-group row"> 
                                    <label for="project_id" class="col-md-3 col-form-label text-md-right required"> Project Name</label>
                                    <div class="col-md-9">
                                        <select id="project_id" class="form-control" required name="project_id">
                                                <option value="{{ old('project_id') }}"> {{ old('project_id') }}</option>
                                                @foreach($project as $projects)
                                                <option value="{{$projects->id}}">{{$projects->name}}</option>  
                                                @endforeach   
                                        </select>  
                                        @error('project_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                        </div>
                                    </div>
                              

                        <div class="form-group row">
                            <label for="site_name" class="col-md-3 col-form-label text-md-right">Site Name<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="site_name" 
                                       type="text" 
                                       minlength="1"
                                       class="form-control @error('site_name') is-invalid @enderror" 
                                       name="site_name" 
                                       value="" 
                                       required autocomplete="site_name" 
                                       autofocus >
                                @error('site_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="visit_date" class="col-md-3 col-form-label text-md-right">First Visit Date<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="visit_date" 
                                       type="date" 
                                       minlength="1"
                                       class="form-control @error('visit_date') is-invalid @enderror" 
                                       name="visit_date" 
                                       value="" 
                                       required autocomplete="visit_date" 
                                       autofocus >
                                @error('visit_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">

                            <div class="col-md-6 offset-md-4">
                            <a class="pull-left btn btn-primary" href="{{ url()->previous() }}">Back</a>
                                <button type="submit" class="btn btn-primary">
                                   Register
                                </button>
                                </div>
                                </div>
            </form>
           
           
    @stop
