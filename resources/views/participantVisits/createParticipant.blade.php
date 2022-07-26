@extends('adminlte::page')
@section('css')

@stop
@section('js')
<script>
    $(document).ready(function() {
        $('.participant-select').select2();
    });
</script>
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Enrol Participant to {{$project->name}} </h4>
        </div>
   
        <div class="card-body">
            <form action="{{route('participantVisits.storeParticipant', $project->id)}}" method="post">
                    {!! csrf_field() !!}
                
                @if($project->include_screening == "Yes")
                <div class="form-group row">
                    <label for="participant_id" class="col-md-3 col-form-label text-md-left">Select Participant<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="participant_id" class="form-control form-select participant-select @error('participant_id') is-invalid @enderror" id="participant_id">
                            <option disabled selected value="">Please select a participant from previously screened Participants</option>
                            @foreach($screenedParticipants as $participant)
                            <option value="{{$participant}}">{{$participant}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @else
                <div class="form-group row">
                    <label for="participant_id" class="col-md-3 col-form-label text-md-left">Participant ID<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="participant_id" type="text" class="form-control @error('participant_id') is-invalid @enderror" 
                                name="participant_id" placeholder="Please enter a valid Participant ID for the participant to enrol" autocomplete="participant_id" autofocus >
                        @error('participant_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                </div>
                @endif

                <div class="form-group row">
                    <label for="site_id" class="col-md-3 col-form-label text-md-left">Select Site<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="site_id" required class="form-control @error('site_id') is-invalid @enderror" id="site_id">
                            <option disabled selected value="">Please select the Site for which the Participant is to be enrolled</option>
                            @foreach($assignedSites as $site)
                            <option value="{{$site->id}}">{{$site->site_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if (!$project->studyArms->isEmpty())
                <div class="form-group row">
                    <label for="study_arm_id" class="col-md-3 col-form-label text-md-left">Select Study Arm<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="study_arm_id" required class="form-control @error('study_arm_id') is-invalid @enderror" id="study_arm_id">
                            <option disabled selected value="">Please select the Study arm to enrol the participant</option>
                            @foreach($project->studyArms as $studyArm)
                            <option value="{{$studyArm->id}}">{{$studyArm->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                <div class="form-group row">
                    <label for="first_visit_date" class="col-md-3 col-form-label text-md-left">Enter visit date for {{$firstProjectVisitName}}  <span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input required id="first_visit_date" type="date" class="form-control @error('first_visit_date') is-invalid @enderror" 
                                name="first_visit_date" value="{{ old('first_visit_date') }}" autocomplete="first_visit_date" autofocus >
                        @error('first_visit_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="mark_first_visit_complete" class="col-md-3 col-form-label text-md-left">Mark the {{$firstProjectVisitName}} visit as Complete<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="mark_first_visit_complete" required class="form-control @error('mark_first_visit_complete') is-invalid @enderror" id="mark_first_visit_complete">
                            <option disabled selected value="">Please select whether to mark the first visit for this participant as complete or not</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>

                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-5">
                    <a class="pull-left btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        <button type="submit" class="btn btn-success">
                            Save Participant
                        </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>  

@endsection

@section('js')

@stop