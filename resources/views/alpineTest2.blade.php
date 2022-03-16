@extends('adminlte::page')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row"
    x-data="{
        showDiffScr = false,
        showVisLabels = false,
    }"
>
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
                    <label for="include_screening" class="col-md-3 col-form-label text-md-left">Include Screening Visit<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="include_screening" class="form-control @error('include_screening') is-invalid @enderror" id="include_screening">
                            <option disabled selected value="">Please select preferred option</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                    
                    </div>
                    <div id="break_screening_div" class="form-group col-md-9 row">
                        <label for="break_screening" class="col-md-6 col-form-label text-md-left">Use different Screening visit labels<span class="required"><font color="red">*</font></span></label>
                        <div class="col-md-12">
                            <select name="break_screening" class="form-control @error('break_screening') is-invalid @enderror" id="break_screening">
                                <option disabled selected value="">Please select preferred option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                    
                    </div>
                    <div id="screening_visit_labels_div" class="form-group col-md-9 row">
                        <label for="screening_visit_labels" class="col-md-6 col-form-label text-md-left">Screening Visit Label<span class="required"><font color="red">*</font></span></label>
                        <a class="btn btn-sm btn-success float-right" id="add_visit"><i class="fas fa-plus-circle"></i> Add Screening Visit</a>
                        <div class="col-md-9">
                            <input id="screening_visit_labels" type="text" class="form-control @error('screening_visit_labels') is-invalid @enderror" 
                                    name="screening_visit_labels[]" placeholder="A name used by your Project for Screening Visit, e.g: Pre-randomization Visit" autofocus >
                            @error('screening_visit_labels')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror 
                            
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                    
                    </div>

                    <div id="dynamic_screening_visit_labels" class="col-md-9">
                        <!-- <div id="screening_visit_labels_div" class="form-group row">
                            <label for="screening_visit_labels" class="col-md-6 col-form-label text-md-left">Screening Visit Label<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                                <input id="screening_visit_labels" type="text" class="form-control @error('screening_visit_labels') is-invalid @enderror" 
                                        name="screening_visit_labels[]" placeholder="A name used by your Project for a Screening Visit, e.g: Pre-randomization Visit" autofocus >
                                @error('screening_visit_labels')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror 
                                
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-sm btn-danger float-right btn_remove_visit" id="add_visit"><i class="fas fa-minus-circle"></i> Remove Visit</a>
                            </div>
                            
                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sites" class="col-md-3 col-form-label text-md-left">Participating Sites<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="sites[]" class="selectpicker form-control @error('sites') is-invalid @enderror" id="sites" multiple>
                            @foreach($sites as $site)
                                <option value="{{$site->id}}">{{$site->site_name}}</option>
                            @endforeach
                        </select>
                        @error('sites')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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

@endsection