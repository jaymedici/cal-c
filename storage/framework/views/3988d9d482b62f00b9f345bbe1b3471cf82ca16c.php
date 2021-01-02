

<?php $__env->startSection('title', 'AdminLTE'); ?>

<?php $__env->startSection('content_header'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

      <?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">

<!-- Example row of columns -->
<h3 align="center">Edit Visit </h3>

      <div class="row col-sm-12 col-md-12 col-lg-12" style="background:white; margin: 10px">
     
      <form method="post" action="<?php echo e(route('visits.update',[$visit->id])); ?>">
                           <?php echo e(csrf_field()); ?>

                           <input type="hidden" name="_method" value="put">
                        


<div  class="form-group row">
                                    
                                    <label for="project_id" class="col-md-3 col-form-label text-md-right required"> Project Name</label>
                                    <div class="col-md-9">
                                        <select id="project_id" class="form-control" required name="project_id">
                                                <option value="<?php echo e($visit->project_id); ?>"> <?php echo e($visit->project->name); ?></option>
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
                            <label for="visit_name" class="col-md-3 col-form-label text-md-right">Visit Name or Number<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="visit_name" 
                                       type="text" 
                                       minlength="1"
                                       class="form-control <?php $__errorArgs = ['visit_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="visit_name" 
                                       value="<?php echo e($visit->visit_name); ?>"
                                       required autocomplete="visit_name" 
                                       autofocus >
                                <?php $__errorArgs = ['visit_name'];
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
                            <label for="number_of_days" class="col-md-3 col-form-label text-md-right">Number of Days from first Visit<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="number_of_days" 
                                       type="number" 
                                       minlength="1"
                                       class="form-control <?php $__errorArgs = ['number_of_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="number_of_days" 
                                       value="<?php echo e($visit->number_of_days); ?>" 
                                       required autocomplete="number_of_days" 
                                       autofocus >
                                <?php $__errorArgs = ['number_of_days'];
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
                            <label for="window_period" class="col-md-3 col-form-label text-md-right">Window Period<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                               <input id="window_period" 
                                       type="number" 
                                       minlength="1"
                                       class="form-control <?php $__errorArgs = ['window_period'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="window_period" 
                                       value="<?php echo e($visit->window_period); ?>" 
                                       required autocomplete="window_period" 
                                       autofocus >
                                <?php $__errorArgs = ['window_period'];
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
                                   Save
                                </button>
                                </div>
                                </div>
                                
</form>  


       <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                <a class="pull-right btn alert-danger" href="#"
                   onclick="
                   var result = confirm('Are you sure you wish to delete this Visit? Click OK to proceed or Cancel to Cancel');
                           if (result){
                             event.preventDefault();
                             document.getElementById('delete-form').submit();
                           }"
                >
              Delete</a>
              <form id="delete-form" action="<?php echo e(route('visits.destroy',[$visit->id])); ?>"
                    method="POST" style="display:none;">
                        <input type="hidden" name="_method" value="delete">
                        <?php echo e(csrf_field()); ?>

                        </form>
                        </div>
                        </div>
</div>
      </div> 

   
    


        <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/visits/edit.blade.php ENDPATH**/ ?>