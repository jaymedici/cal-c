<div>
    <form wire:submit.prevent="saveVisitAction(<?php echo e($appointment); ?>)" action="">

    <div class="row">
    <div class="form-group ">
        <div class="custom-control custom-radio">
            <input wire:model="form_state.visit_status" class="custom-control-input custom-control-success <?php $__errorArgs = ['visit_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="radio" value="Completed" name="visitAction" id="customRadio">
            <label for="customRadio" class="custom-control-label">Mark Visit as Completed</label>
        </div>

        <div class="custom-control custom-radio">
            <input wire:model="form_state.visit_status" class="custom-control-input custom-control-input-danger <?php $__errorArgs = ['visit_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="radio" value="Missed" name="visitAction" id="customRadio2">
            <label for="customRadio2" class="custom-control-label">Mark Visit as Missed</label>
            <?php $__errorArgs = ['visit_status'];
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
    <br>
    </div>

    <?php if(isset($form_state['visit_status']) && $form_state['visit_status'] == "Completed"): ?>
    <div class="row form-group">
        <label for="actual_visit_date">Completed Date</label>
        <input wire:model="form_state.actual_visit_date" type="date" name="actual_visit_date" class="form-control <?php $__errorArgs = ['actual_visit_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="actual_visit_date">
        <?php $__errorArgs = ['actual_visit_date'];
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
    <?php endif; ?>

    <div class="row">
        <button class="btn btn-success" type="submit">Save Visit</button>
    </div>
    </form>

</div>
<?php /**PATH C:\xampp\htdocs\cal-c\resources\views/livewire/appointments/visit-actions.blade.php ENDPATH**/ ?>