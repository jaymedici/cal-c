<div class="card card-outline card-secondary col-md-12">
    <div class="card-header">
        <div class="card-title mr-4">
            <h5>Participant Appointments</h5>
        </div>
        <div class="card-title mr-4">
            <a wire:click='createAppointment()' class="btn btn-sm btn-success"> <i class="fa fa-plus-circle"></i> Create Appointment</a>
        </div>

        <!-- <div class="card-title form-group mr-2">
            <select class="form-control-sm" name="">
                <option selected disabled value="">Site Filter</option>
            </select>
        </div>

        <div class="card-title mr-2">
            <button class="btn btn-sm btn-info">
               <i class="fa fa-calendar-alt" aria-hidden="true"></i> Date Filter
            </button>
        </div> -->

        <div class="card-tools">
            <div class="input-group input-group-sm">
                <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search Participant...">
                <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Participant ID</th>
                    <th>Date & Time</th>
                    <th>Visit Type</th>
                    <th>Project</th>
                    <th>Site</th>
                    <th>Created By</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($appointments as $appointment)
                    <tr wire:loading.remove>
                        <td>
                            {{ $appointment->participant_id }}
                            @if ($appointment->participantVisit)
                                @if (!$appointment->participantVisit->project->studyArms->isEmpty())
                                ({{$appointment->participantVisit->participant->studyArm->name}})
                                @endif
                            @endif
                        </td>
                        <td>{{ $appointment->appointment_date_time }}</td>
                        @if (!empty($appointment->participant_visit_id))
                        <td>{{ $appointment->participantVisit->visit->visit_name}}</td>
                        @else
                            @if(!empty($appointment->screening->screening_label))
                            <td>{{ $appointment->screening->screening_label }}</td>
                            @else
                            <td>{{ $appointment->screening_visit_label }}</td>
                            @endif             
                        @endif
                        <td>{{ $appointment->project->name }}</td>
                        <td>{{ $appointment->site->site_name }}</td>
                        <td>{{ $appointment->updated_by }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="6">No Result Found... </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div wire:loading>
            Processing your query...
        </div>

        <div class="d-flex justify-content-end">
        {!! $appointments->links() !!}
        </div>
    </div>

    <!-- Appointment Creation Form Modal -->
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
</div>