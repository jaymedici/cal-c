<div wire:ignore.self class="modal fade" id="changeStudyArmForm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <form wire:submit.prevent="updateParticipantStudyArm">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="changeStudyArmFormLabel">Change Participant's Study Arm</h5>
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
                <label for="study_arm_id">Study Arm</label>
                <select wire:model.defer="edit_form_state.study_arm_id" class="participant-select form-control form-select @error('study_arm_id') is-invalid @enderror">
                    <option value="" selected>Select Study Arm to enrol Participant</option>
                    @foreach ($project->studyArms as $studyArm)
                        <option value="{{$studyArm->id}}">{{$studyArm->name}}</option>
                    @endforeach
                </select>
                @error('study_arm_id')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Details</button>
        </div>
        </div>
    </form>
    </div>
</div>