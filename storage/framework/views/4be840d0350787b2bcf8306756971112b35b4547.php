
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="card card-secondary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Create Appointment</h4>
        </div>

        <div class="card-body">
            <form action="<?php echo e(route('appointments.storeByVisit', $visit->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>


                <div class="form-group row">
                    <label for="participant_id" class="col-md-3 col-form-label text-md-left">Participant ID<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="participant_id" type="text" class="form-control <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                name="participant_id" readonly value="<?php echo e($visit->participant_id); ?>" required autocomplete="participant_id" autofocus >
                        <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="project_name" class="col-md-3 col-form-label text-md-left">Project<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="project_name" type="text" class="form-control <?php $__errorArgs = ['project_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                name="project_name" disabled value="<?php echo e($visit->project->name); ?>" required autocomplete="project_name" autofocus >
                        <?php $__errorArgs = ['project_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="site_name" class="col-md-3 col-form-label text-md-left">Site<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="site_name" type="text" class="form-control <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                name="site_name" disabled value="MMRC" required autocomplete="site_name" autofocus >
                        <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="appointment_date_time" class="col-md-3 col-form-label text-md-left">Appointment Date & Time<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="appointment_date_time" type="datetime-local" class="form-control <?php $__errorArgs = ['appointment_date_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                name="appointment_date_time" required autocomplete="appointment_date_time" autofocus >
                        <?php $__errorArgs = ['appointment_date_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>                

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-6">
                    <a class="pull-left btn btn-primary" href="<?php echo e(url()->previous()); ?>">Back</a>
                        <button type="submit" class="btn btn-success">
                            Save Appointment
                        </button>
                        </div>
                </div>

            </form>
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/appointments/createFromVisit.blade.php ENDPATH**/ ?>