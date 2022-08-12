<div wire:ignore.self class="modal fade" id="editParticipantVisitForm" tabindex="-1" role="dialog" aria-labelledby="editParticipantVisitFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form wire:submit.prevent="updateParticipantVisitStatus">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editParticipantVisitFormLabel">Edit Participant Visit Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="participant_id">Participant ID</label>
                <input type="text" wire:model.defer="edit_form_state.participant_id" class="form-control @error('participant_id') is-invalid @enderror" disabled>
                @error('participant_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="visit_name">Visit Name</label>
                <input type="text" wire:model.defer="edit_form_state.visit_name" class="form-control @error('visit_name') is-invalid @enderror" disabled>
                @error('visit_name')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="visit_status">Visit Status</label>
                <select wire:model.defer="edit_form_state.visit_status" class="form-control form-select @error('visit_status') is-invalid @enderror">
                    <option selected value=""> </option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Missed">Missed</option>
                </select>
                @error('visit_status')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>

                
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </div>
        </form>
    </div>
</div>