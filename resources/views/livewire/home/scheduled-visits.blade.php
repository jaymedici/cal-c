<div>
    <div class="card card-outline card-success">
        <div class="card-header border-transparent">
            <h3 class="card-title">Scheduled Visits for the coming two Weeks</h3>
            <div class="card-tools">
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Participant ID</th>
                            <th>Visit</th>
                            <th>Window</th>
                            <th>Set Appt</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scheduledParticipantVisits as $participantVisit)
                        <tr>
                            <td>{{ $participantVisit->project->name}} </td>
                            <td>{{ $participantVisit->participant_id}} </td>
                            <td>{{ $participantVisit->visit->visit_name}}</td>
                            <td>{{ $participantVisit->window_start_date_formatted }} - <br> {{ $participantVisit->window_end_date_formatted }} </td>
                            @if($participantVisit->appointment()->exists())
                            <td>{{ $participantVisit->appointment->appointment_date_time_formatted }}</td>
                            <td><a class="btn btn-sm btn-warning" href="#" wire:click.prevent="changeAppointment({{$participantVisit}})"> <i class="fa fa-pen-square"></i> Change Appt.</a></td>
                            @else
                            <td><i>No set Appt...</i></td>
                            <td><a class="btn btn-sm btn-primary" href="" wire:click.prevent="setAppointment({{$participantVisit}})"> <i class="fa fa-plus-circle"></i> Set Appt.</a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="float-right">
                <a href="{{ route('participantVisits.viewVisits') }}">View All Visits</a>
            </div>
            {{ $scheduledParticipantVisits->links() }}
        </div>

    </div>

    <!-- Set Appointment Modal -->
    <div wire:ignore.self class="modal fade" id="setAppointmentForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <form wire:submit.prevent="saveAppointment">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setAppointmentFormLabel">Create Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Participant ID</label>
                    <input type="text" wire:model.defer="create_form_state.participant_id" class="form-control @error('participant_id') is-invalid @enderror" disabled>
                    @error('participant_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Project</label>
                    <input type="text" wire:model.defer="create_form_state.project_name" class="form-control @error('project_name') is-invalid @enderror" disabled>
                    @error('project_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Site</label>
                    <input type="text" wire:model.defer="create_form_state.site_name" class="form-control @error('site_name') is-invalid @enderror" disabled>
                    @error('site_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
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
                <button type="submit" class="btn btn-primary">Save Appointment</button>
            </div>
            </div>
        </form>
        </div>
    </div>

    <!-- Change Appointment Modal -->
    <div wire:ignore.self class="modal fade" id="changeAppointmentForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <form wire:submit.prevent="updateAppointment">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeAppointmentFormLabel">Change Appointment Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Participant ID</label>
                    <input type="text" wire:model.defer="edit_form_state.participant_id" class="form-control @error('participant_id') is-invalid @enderror" disabled>
                    @error('participant_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Project</label>
                    <input type="text" wire:model.defer="edit_form_state.project_name" class="form-control @error('project_name') is-invalid @enderror" disabled>
                    @error('project_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Site</label>
                    <input type="text" wire:model.defer="edit_form_state.site_name" class="form-control @error('site_name') is-invalid @enderror" disabled>
                    @error('site_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Appointment Date & Time</label>
                    <input type="datetime-local" wire:model.defer="edit_form_state.appointment_date_time" class="form-control @error('appointment_date_time') is-invalid @enderror">
                    @error('appointment_date_time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Appointment</button>
            </div>
            </div>
        </form>
        </div>
    </div>

</div>
