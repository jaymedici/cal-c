<div wire:ignore.self class="modal fade" id="editScreeningForm" tabindex="-1" role="dialog" aria-labelledby="editScreeningFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form wire:submit.prevent="updateScreening">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editScreeningFormLabel">Edit Screening Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="participant_id">Participant ID</label>
                <input type="text" wire:model.defer="edit_form_state.participant_id" class="form-control @error('participant_id') is-invalid @enderror"  placeholder="Enter Participant Id">
                @error('participant_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="screening_date">Screening Date</label>
                <input type="date" wire:model.defer="edit_form_state.screening_date" class="form-control @error('screening_date') is-invalid @enderror"  placeholder="Enter Screening Date">
                @error('screening_date')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="screening_label">Screening Visit</label>
                <select wire:model.defer="edit_form_state.screening_label" class="form-control form-select @error('screening_label') is-invalid @enderror">
                    <option selected disabled> </option>
                    @foreach ($screeningLabels as $key => $value)
                    <option value="{{$value}}">{{$value}}</option>
                    @endforeach
                </select>
                @error('screening_label')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="still_screening">Still Screening?</label>
                <select wire:model.defer="edit_form_state.still_screening" class="form-control form-select @error('still_screening') is-invalid @enderror">
                    <option selected disabled> </option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                @error('still_screening')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="screening_outcome">Screening Outcome</label>
                <select wire:model.defer="edit_form_state.screening_outcome" class="form-control form-select @error('screening_outcome') is-invalid @enderror">
                    <option selected disabled> </option>
                    <option value="Continue Screening">Continue Screening</option>
                    <option value="Enrol">Enrol</option>
                    <option value="Screen Failure">Screen Failure</option>
                </select>
                @error('screening_outcome')
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