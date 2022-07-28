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