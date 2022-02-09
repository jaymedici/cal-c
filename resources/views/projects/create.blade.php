@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@stop

@section('content')

      @include('partials.errors')
      @include('partials.errors2')
      @include('partials.success')

<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Register New Project </h4>
        </div>
   

        <div class="card-body">
            <form action="{{route('projects.store')}}" method="post">
                {!! csrf_field() !!}

                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-left">Project Name<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-3 col-form-label text-md-left">Project Description<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <textarea name="description" max="1900" class="form-control @error('description') is-invalid @enderror" id="description" cols="80" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="include_screening" class="col-md-3 col-form-label text-md-left">Include Screening Feature?<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="include_screening" class="form-control @error('include_screening') is-invalid @enderror" id="include_screening">
                            <option disabled selected value="">Please select preferred option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="managers" class="col-md-3 col-form-label text-md-left">Project Manager(s)<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="managers[]" class="selectpicker form-control @error('managers') is-invalid @enderror" id="managers" multiple>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('managers')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-6">
                    <a class="pull-left btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        <button type="submit" class="btn btn-success">
                            Register
                        </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>      


           
@stop
	
	
	
	
