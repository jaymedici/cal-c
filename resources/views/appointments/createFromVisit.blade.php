@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-secondary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Create Appointment</h4>
        </div>

        <div class="card-body">
            <form action="{{route('appointments.storeByVisit', $visit->id)}}" method="post">
                    {!! csrf_field() !!}

                <div class="form-group row">
                    <label for="participant_id" class="col-md-3 col-form-label text-md-left">Participant ID<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="participant_id" type="text" class="form-control @error('participant_id') is-invalid @enderror" 
                                name="participant_id" readonly value="{{$visit->participant_id}}" required autocomplete="participant_id" autofocus >
                        @error('participant_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="project_name" class="col-md-3 col-form-label text-md-left">Project<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" 
                                name="project_name" disabled value="{{ $visit->project->name }}" required autocomplete="project_name" autofocus >
                        @error('project_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="site_name" class="col-md-3 col-form-label text-md-left">Site<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="site_name" type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                name="site_name" disabled value="MMRC" required autocomplete="site_name" autofocus >
                        @error('site_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="appointment_date_time" class="col-md-3 col-form-label text-md-left">Appointment Date & Time<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="appointment_date_time" type="datetime-local" class="form-control @error('appointment_date_time') is-invalid @enderror" 
                                name="appointment_date_time" required autocomplete="appointment_date_time" autofocus >
                        @error('appointment_date_time')
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
                            Save Appointment
                        </button>
                        </div>
                </div>

            </form>
        </div>
    </div>
</div>  

@endsection