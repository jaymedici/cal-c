@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')

      @include('partials.errors')
      @include('partials.errors2')
      @include('partials.success')

<div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">

<!-- Example row of columns -->
<h3 align="center">Edit Schedule </h3>

      <div class="row col-sm-12 col-md-12 col-lg-12" style="background:white; margin: 10px">
     
      <form method="post" action="{{route('calculators.update',[$visit->id])}}">
                           {{csrf_field()}}
                           <input type="hidden" name="_method" value="put">
                        

                           <div class="form-group row">
                            <label for="patient_id" class="col-md-3 col-form-label text-md-right">Participant ID<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="patient_id" 
                                       type="text" 
                                       minlength="1"
                                       class="form-control @error('patient_id') is-invalid @enderror" 
                                       name="patient_id" 
                                       readonly
                                       value="{{$visit->patient_id}}" 
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
                                        <select id="project_id" class="form-control" required readonly name="project_id">
                                                <option value="{{$visit->project_id}}"> {{$visit->project->name}}</option>
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
                                       readonly
                                       value="{{$visit->site_name}}" 
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
                                       readonly
                                       class="form-control @error('visit_date') is-invalid @enderror" 
                                       name="visit_date" 
                                       value="{{$visit->visit_date}}" 
                                       required autocomplete="visit_date" 
                                       autofocus >
                                @error('visit_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div  class="form-group row"> 
                                    <label for="visit_status" class="col-md-3 col-form-label text-md-right required"> Visit Status</label>
                                    <div class="col-md-9">
                                        <select id="visit_status" class="form-control" required name="visit_status">
                                                <option value="{{$visit->visit_status}}"> {{$visit->visit_status}}</option>
                                                <option value="Completed">Completed</option>  
                                                <option value="Pending">Pending</option>
                                                <option value="Pending and On Window">Pending and On Window</option>   
                                                <option value="Missed Visit">Missed Visit</option>   
                                                
                                        </select>  
                                        @error('visit_status')
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
                                   Save
                                </button>
                                </div>
                                </div>

                               
                       


                                
</form>  


                            <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                <a class="pull-right btn alert-danger" href="#"
                   onclick="
                   var result = confirm('Are you sure you wish to delete this Participant? Note that all the Visits information for this participant will be deleted! Click OK to proceed or Cancel to Cancel');
                           if (result){
                             event.preventDefault();
                             document.getElementById('delete-form').submit();
                           }"
                >
              Delete</a>
              <form id="delete-form" action="{{route('calculators.destroy',[$visit->patient_id])}}"
                    method="POST" style="display:none;">
                        <input type="hidden" name="_method" value="delete">
                        {{csrf_field()}}
                        </form>
                        </div>
                        </div>
                 
</div>
      </div> 

   
    


        @stop