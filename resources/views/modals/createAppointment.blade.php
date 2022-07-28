<div wire:ignore.self class="modal fade" id="createAppointmentForm" tabindex="-1" role="dialog" aria-labelledby="createAppointmentFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <form wire:submit.prevent="saveAppointment">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createAppointmentFormLabel">Create Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                @if (session()->has('message'))
                <div class="col-md-12 alert alert-warning alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Project</label>
                        <input type="text" class="form-control" value="{{$projectName}}" disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Site</label>
                        <select type="text" wire:model.defer="create_form_state.site_id" class="form-control @error('site_id') is-invalid @enderror">
                            <option value="" selected>Choose a Site</option>
                            @foreach ($sites as $site)
                            <option value="{{$site->id}}">{{$site->site_name}}</option>
                            @endforeach
                        </select>
                        @error('site_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="participant_id">Participant ID</label>
                <select wire:model.defer="create_form_state.participant_id" class="participant-select form-control form-select @error('participant_id') is-invalid @enderror">
                    <option value="" selected>Select Participant</option>
                    <option value="No ID yet">Participant not assigned ID yet</option>
                    @foreach ($participantIds as $key => $value)
                        <option value="{{$value}}">{{$value}}</option>
                    @endforeach
                </select>
                @error('participant_id')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>

            <div x-data="{ visitType: '' }" class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="visit_type">Visit Type</label>
                        <select wire:model.defer="create_form_state.visit_type" 
                                x-model="visitType" 
                                class="participant-select form-control form-select @error('visit_type') is-invalid @enderror">
                            <option value="" selected>Select reason why the participant will be visiting</option>
                            <option value="Test results pickup">Test results pickup</option>
                            <option value="Screening">Screening</option>
                            <option value="Scheduled Visit">Scheduled Visit</option>
                            <option value="Unscheduled Visit">Unscheduled Visit</option>
                        </select>
                        @error('visit_type')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div x-show="visitType === 'Screening'" x-transition class="form-group">
                        <label for="screening_visit_label">Screening Visit Type</label>
                        <select wire:model.defer="create_form_state.screening_visit_label" class="participant-select form-control form-select @error('screening_visit_label') is-invalid @enderror">
                            <option value="" selected>Select screening visit</option>
                            @foreach ($screeningLabels as $key => $value)
                                <option value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('screening_visit_label')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div x-show="visitType === 'Scheduled Visit'" x-transition class="form-group">
                        <label for="visit_id">Visit name</label>
                        <select wire:model.defer="create_form_state.visit_id" class="participant-select form-control form-select @error('visit_id') is-invalid @enderror">
                            <option value="" selected>Select participant visit</option>
                            @foreach ($projectVisits as $visit)
                                <option value="{{$visit->id}}">{{$visit->visit_name}}</option>
                            @endforeach
                        </select>
                        @error('visit_id')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>        

            <div class="form-group">
                <label for="name">Appointment Date & Time</label>
                <input type="datetime-local" wire:model.defer="create_form_state.appointment_date_time" class="form-control @error('appointment_date_time') is-invalid @enderror">
                @error('appointment_date_time')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </div>
    </form>
    </div>
</div>