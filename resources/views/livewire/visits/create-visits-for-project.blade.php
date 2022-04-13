<div>
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
                            <a wire:click.prevent="addVisit" class="btn btn-success float-right" id="add_visit"><i class="fas fa-plus-circle"></i> Add Visit</a>
                        </div>
                    </div>
                    <br>

                   
                    @foreach ($visits as $index => $visit)
                    <div class="shadow p-3 mb-5 bg-white rounded form-group row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="visit_name">Visit Label<span class="required"><font color="red">*</font></span></label>
                                <input required type="text" class="form-control" name="visit_names[]">
                            </div>  
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="days_from_first_visit">Days from 1st Visit<span class="required"><font color="red">*</font></span></label>
                                <input required type="text" class="form-control" name="days_from_first_visit[]">
                            </div>  
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="plus_window_period">Window Period (+)<span class="required"><font color="red">*</font></span></label>
                                <input required type="text" class="form-control" name="plus_window_periods[]">
                            </div>  
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="minus_window_period">Window Period (-)<span class="required"><font color="red">*</font></span></label>
                                <input required type="text" class="form-control" name="minus_window_periods[]">
                            </div>  
                        </div>

                        <div class="col-md-3">
                            <a wire:click.prevent="removeVisit({{$index}})" style="margin-top: 30px;" class="btn btn-danger" href=""><i class="fas fa-minus-circle"></i> Remove Visit</a>
                            <a wire:click.prevent="addVisit" style="margin-top: 30px;" class="btn btn-success" href=""><i class="fas fa-plus-circle"></i> Add Visit</a>
                        </div>
                    </div>
                    @endforeach

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
</div>
