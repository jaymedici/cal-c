
<?php $__env->startSection('content'); ?>

      <?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('partials.errors2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">
<h3 align="center">Create New </h3>
<!-- Example row of columns -->
<div class="row col-sm-12 col-md-12 col-lg-12" style="background:white; margin: 10px">
            <form action="<?php echo e(route('calculators.store')); ?>" method="post">
                <?php echo csrf_field(); ?>



                <div class="form-group row">
                            <label for="patient_id" class="col-md-3 col-form-label text-md-right">Participant ID<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="patient_id" 
                                       type="text" 
                                       minlength="1"
                                       class="form-control <?php $__errorArgs = ['patient_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="patient_id" 
                                       value="<?php echo e(old('patient_id')); ?>" 
                                       required autocomplete="patient_id" 
                                       autofocus >
                                <?php $__errorArgs = ['patient_id'];
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

                                <div  class="form-group row"> 
                                    <label for="project_id" class="col-md-3 col-form-label text-md-right required"> Project Name</label>
                                    <div class="col-md-9">
                                        <select id="project_id" class="form-control" required name="project_id">
                                                <option value="<?php echo e(old('project_id')); ?>"> <?php echo e(old('project_id')); ?></option>
                                                <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($projects->id); ?>"><?php echo e($projects->name); ?></option>  
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                        </select>  
                                        <?php $__errorArgs = ['project_id'];
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
                            <label for="site_name" class="col-md-3 col-form-label text-md-right">Site Name<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="site_name" 
                                       type="text" 
                                       minlength="1"
                                       class="form-control <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="site_name" 
                                       value="<?php echo e(old('site_name')); ?>" 
                                       required autocomplete="site_name" 
                                       autofocus >
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
                            <label for="visit_date" class="col-md-3 col-form-label text-md-right">First Visit Date<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="visit_date" 
                                       type="date" 
                                       minlength="1"
                                       class="form-control <?php $__errorArgs = ['visit_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="visit_date" 
                                       value="<?php echo e(old('visit_date')); ?>" 
                                       required autocomplete="visit_date" 
                                       autofocus >
                                <?php $__errorArgs = ['visit_date'];
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

                            <div class="col-md-6 offset-md-4">
                            <a class="pull-left btn btn-primary" href="<?php echo e(url()->previous()); ?>">Back</a>
                                <button type="submit" class="btn btn-primary">
                                   Register
                                </button>
                                </div>
                                </div>
            </form>
           
           
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/visitcalculator/create.blade.php ENDPATH**/ ?>