@extends('adminlte::page')
@section('css')

@stop
@section('js')
<script>
    $(window).on('load', function() {
        participant_type_change(document.getElementById("participant_type"));
        screening_outcome_change(document.getElementById("screening_outcome"));
        
    });

    function participant_type_change(obj)
    {
        //console.log(obj);
        var participant_id_div = document.getElementById("participant_id_div");
        var participant_id_select_div = document.getElementById("participant_id_select_div");

        if (obj.value == 'New')
        {
            participant_id_div.style.display = "block";
            participant_id_select_div.style.display = "none";
        }
        else if (obj.value == 'Returning')
        {
            participant_id_select_div.style.display = "block";
            participant_id_div.style.display = "none";
        }
        else
        {
            participant_id_div.style.display = "none";
            participant_id_select_div.style.display = "none";
        }
    }

    function screening_outcome_change(obj)
    {
        //console.log(obj);
        var next_screening_date_div = document.getElementById("next_screening_date_div");

        if (obj.value == 'Continue Screening')
        {
            next_screening_date_div.style.display = "block";
        }
        else
        {
            next_screening_date_div.style.display = "none";
        }
    }

    function project_selected(obj)
    {
        var projectId = $(obj).val();

        if(projectId)
        {
            $.ajax(
                {
                    type:"GET",
                    url:"{{url('screening/getScreeningTypes')}}/"+projectId,
                    success:function(res){
                        console.log(res);
                        if(res)
                        {
                            $('#screening_label').empty();
                            $('#screening_label').append('<option value="Screening" selected>Screening</option>');
                            $.each(res,function(key,value)
                            {
                                $('#screening_label').append('<option value="'+value+'">'+value+'</option>');
                            });
                        }
                else {
                    $('#screening_label').empty();
                    $("#screening_label").append('<option value="Screening" selected>Screening</option>'); 
                }
                    }
                });
        }
    }
</script>
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-secondary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Screen Patient </h4>
        </div>
   

        <div class="card-body">
            <form action="{{route('screening.store')}}" method="post">
                {!! csrf_field() !!}

                <div class="form-group row">
                    <label for="project_id" class="col-md-3 col-form-label text-md-left">Project<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="project_id" class="form-control @error('project_id') is-invalid @enderror" id="project_id" onchange="project_selected(this)">
                            <option disabled selected value="">Please select a Project</option>
                            @foreach($projectsWithScreening as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="screening_label" class="col-md-3 col-form-label text-md-left">Screening Label<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="screening_label" class="form-control @error('screening_label') is-invalid @enderror" id="screening_label">
                            <option selected value="Screening">Screening</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="participant_type" class="col-md-3 col-form-label text-md-left">Participant type<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="participant_type" class="form-control @error('participant_type') is-invalid @enderror" id="participant_type" onchange="participant_type_change(this)">
                            <option disabled selected value="">Please select the type of Participant you're screening</option>
                            <option value="New">New Participant</option>
                            <option value="Returning">Returning Participant</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                    
                    </div>
                    <div class="form-group col-md-9 row" id="participant_id_div" style="display: none" >
                        <label for="participant_id" class=" col-md-2 col-form-label text-md-left">Participant ID<span class="required"><font color="red">*</font></span></label>
                        <div class="col-md-7">
                            <input id="participant_id" type="text" class="form-control @error('participant_id') is-invalid @enderror" 
                                    name="participant_id" value="{{ old('participant_id') }}" autocomplete="participant_id" autofocus >
                            @error('participant_id')
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
                    <div id="participant_id_select_div" style="display: none" class="form-group col-md-9 row">
                        <label for="participant_id_select" class="col-md-3 col-form-label text-md-left">Select Participant<span class="required"><font color="red">*</font></span></label>
                        <div class="col-md-6">
                            <select name="participant_id_select" class="form-control @error('participant_id_select') is-invalid @enderror" id="participant_id_select">
                                <option disabled selected value="">Please select the returning Participant</option>
                                @foreach($projectsWithScreening as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="screening_date" class="col-md-3 col-form-label text-md-left">Screening Date<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input required id="screening_date" type="date" class="form-control @error('screening_date') is-invalid @enderror" 
                                name="screening_date" value="{{ old('screening_date') }}" autocomplete="screening_date" autofocus >
                        @error('screening_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="screening_outcome" class="col-md-3 col-form-label text-md-left">Screening Outcome<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="screening_outcome" class="form-control @error('screening_outcome') is-invalid @enderror" id="screening_outcome" onchange="screening_outcome_change(this)">
                            <option disabled selected value="">Please select the outcome after screening</option>
                            <option value="Continue Screening">Continue Screening</option>
                            <option value="Enrol">Enrol</option>
                            <option value="Screen Failure">Screen Failure</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                    
                    </div>
                    <div id="next_screening_date_div" style="display: none" class="form-group col-md-9 row">
                        <label for="next_screening_date" class="col-md-3 col-form-label text-md-left">Next Screening Date<span class="required"><font color="red">*</font></span></label>
                        <div class="col-md-6">
                            <input id="next_screening_date" type="date" class="form-control @error('next_screening_date') is-invalid @enderror" 
                                    name="next_screening_date" value="{{ old('next_screening_date') }}" autocomplete="next_screening_date" autofocus >
                            @error('next_screening_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-6">
                    <a class="pull-left btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>    
@endsection