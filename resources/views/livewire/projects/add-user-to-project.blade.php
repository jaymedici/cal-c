<div>
    <a href="" >Add User to Project</a>

    <div wire:ignore.self class="modal fade" id="createForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <form wire:submit.prevent="saveUserAssignment">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFormLabel">Add User to Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">User Email</label>
                    <input type="text" class="form-control @error('participant_id') is-invalid @enderror">
                    @error('participant_id')
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
</div>
