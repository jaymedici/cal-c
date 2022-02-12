@extends('adminlte::page')

@section('css')
   
@stop

@section('js')
<script>
    $(document).ready(function() {
        var i = 1;

        $('#add_visit').click(function() {
            i++;
            var visit_div = '<div id="row'+i+'" style="border: 2px grey solid; border-radius: 10px;" class="form-group row"> <div class="col-md-2"> <div class="form-group"> <label for="visit_type">Visit Type<span class="required"><font color="red">*</font></span></label> <select name="visit_types[]" class="form-control @error('visit_type') is-invalid @enderror" id="visit_type" onchange="visit_type_change(this)"> <option selected value="Regular">Regular</option> <option value="Follow Up">Follow Up</option> </select> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="visit_name">Visit Label<span class="required"><font color="red">*</font></span></label> <input required type="text" class="form-control" id="visit_name" name="visit_names[]"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="days_from_first_visit">Days from 1st Visit<span class="required"><font color="red">*</font></span></label> <input required type="text" class="form-control" id="days_from_first_visit" name="days_from_first_visit[]"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="plus_window_period">Window Period (+)<span class="required"><font color="red">*</font></span></label> <input required type="text" class="form-control" id="plus_window_period" name="plus_window_periods[]"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="minus_window_period">Window Period (-)<span class="required"><font color="red">*</font></span></label> <input required type="text" class="form-control" id="minus_window_period" name="minus_window_periods[]"> </div> </div> <div class="col-md-2"> <a id="'+i+'" style="margin-top: 30px;" class="btn btn-sm btn-danger btn_remove_visit"><i class="fas fa-minus-circle"></i> Remove Visit</a> </div> </div>';

            $('#dynamic_visits').append(visit_div);
        });

        $(document).on('click', '.btn_remove_visit', function() {
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>
@stop

@section('content')

@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Create Visits for Project </h4>
        </div>
   

        <div class="card-body">
            <form action="{{route('visits.storeVisitsForProject', $project->id)}}" method="post">
                {!! csrf_field() !!}

                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-left">Project Name<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input disabled id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ $project->name }}" required autocomplete="name" autofocus >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="visit_1_label" class="col-md-3 col-form-label text-md-left">Randomization visit Label<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-7">
                        <input id="visit_1_label" type="text" class="form-control @error('visit_1_label') is-invalid @enderror" 
                                name="visit_1_label" value="{{ $project->visit_1_label }}" required placeholder="Please enter a name used by your Project for Visit 1, e.g: Baseline" autofocus >
                        @error('visit_1_label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror 
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-success float-right" id="add_visit"><i class="fas fa-plus-circle"></i> Add Visit</a>
                    </div>
                </div>
                <br>

                <div id="dynamic_visits">

                </div>


                <!-- <div style="border: 2px grey solid; border-radius: 10px;" class="form-group row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="visit_name">Visit 2 Label<span class="required"><font color="red">*</font></span></label>
                            <input required type="text" class="form-control" id="visit_name" name="visit_names[]">
                        </div>  
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="days_from_first_visit">No. of days from 1st Visit<span class="required"><font color="red">*</font></span></label>
                            <input required type="text" class="form-control" id="days_from_first_visit" name="days_from_first_visit[]">
                        </div>  
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="visit_type">Visit Type<span class="required"><font color="red">*</font></span></label>
                            <select name="visit_types[]" class="form-control @error('visit_type') is-invalid @enderror" id="visit_type" onchange="visit_type_change(this)">
                                <option selected value="Regular">Regular</option>
                                <option value="Follow Up">Follow Up</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="plus_window_period">Window Period (+)<span class="required"><font color="red">*</font></span></label>
                            <input required type="text" class="form-control" id="plus_window_period" name="plus_window_periods[]">
                        </div>  
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="minus_window_period">Window Period (-)<span class="required"><font color="red">*</font></span></label>
                            <input required type="text" class="form-control" id="minus_window_period" name="minus_window_periods[]">
                        </div>  
                    </div>

                    <div class="col-md-2">
                        <a style="margin-top: 30px;" class="btn btn-danger btn_remove_visit" href=""><i class="fas fa-minus-circle"></i> Remove Visit</a>
                    </div>
                </div> -->


                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-6">
                    <a class="pull-left btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        <button type="submit" class="btn btn-success">
                            Save Visits
                        </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>      


           
@stop
	
	
	
	
