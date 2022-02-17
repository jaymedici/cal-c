@extends('adminlte::page')
@section('css')

@stop
@section('js')

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
                        <select name="participant_id" class="form-control @error('participant_id') is-invalid @enderror" id="participant_id">
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
                    <label for="site_name" class="col-md-3 col-form-label text-md-left">Site Name<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="site_name" type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                name="site_name" required placeholder="Please enter the site name" autocomplete="site_name" autofocus >
                        @error('site_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror      
                    </div>
                </div>

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