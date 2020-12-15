@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')

      @include('partials.errors')
      @include('partials.success')

<div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">

<!-- Example row of columns -->
<h3 align="center">Edit Visit </h3>

      <div class="row col-sm-12 col-md-12 col-lg-12" style="background:white; margin: 10px">
     
      <form method="post" action="{{route('visits.update',[$visit->id])}}">
                           {{csrf_field()}}
                           <input type="hidden" name="_method" value="put">
                        


<div  class="form-group row">
                                    
                                    <label for="project_id" class="col-md-3 col-form-label text-md-right required"> Project Name</label>
                                    <div class="col-md-9">
                                        <select id="project_id" class="form-control" required name="project_id">
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
                            <label for="visit_name" class="col-md-3 col-form-label text-md-right">Visit Name or Number<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="visit_name" 
                                       type="text" 
                                       minlength="1"
                                       class="form-control @error('visit_name') is-invalid @enderror" 
                                       name="visit_name" 
                                       value="{{$visit->visit_name}}"
                                       required autocomplete="visit_name" 
                                       autofocus >
                                @error('visit_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number_of_days" class="col-md-3 col-form-label text-md-right">Number of Days from first Visit<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="number_of_days" 
                                       type="number" 
                                       minlength="1"
                                       class="form-control @error('number_of_days') is-invalid @enderror" 
                                       name="number_of_days" 
                                       value="{{$visit->number_of_days}}" 
                                       required autocomplete="number_of_days" 
                                       autofocus >
                                @error('number_of_days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="window_period" class="col-md-3 col-form-label text-md-right">Window Period<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="window_period" 
                                       type="number" 
                                       minlength="1"
                                       class="form-control @error('window_period') is-invalid @enderror" 
                                       name="window_period" 
                                       value="{{$visit->window_period}}" 
                                       required autocomplete="window_period" 
                                       autofocus >
                                @error('window_period')
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
                   var result = confirm('Are you sure you wish to delete this Visit? Click OK to proceed or Cancel to Cancel');
                           if (result){
                             event.preventDefault();
                             document.getElementById('delete-form').submit();
                           }"
                >
              Delete</a>
              <form id="delete-form" action="{{route('visits.destroy',[$visit->id])}}"
                    method="POST" style="display:none;">
                        <input type="hidden" name="_method" value="delete">
                        {{csrf_field()}}
                        </form>
                        </div>
                        </div>
</div>
      </div> 

   
    


        @stop