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
                    <input type="text" class="form-control <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/projects/add-user-to-project.blade.php ENDPATH**/ ?>