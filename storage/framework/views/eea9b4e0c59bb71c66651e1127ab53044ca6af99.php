

<?php $__env->startSection('css'); ?>
   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function() {
        var i = 1;

        $('#add_visit').click(function() {
            i++;
            var visit_div = '<div id="row'+i+'" style="border: 2px grey solid; border-radius: 10px;" class="form-group row"> <div class="col-md-2"> <div class="form-group"> <label for="visit_type">Visit Type<span class="required"><font color="red">*</font></span></label> <select name="visit_types[]" class="form-control <?php $__errorArgs = ['visit_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="visit_type" onchange="visit_type_change(this)"> <option selected value="Regular">Regular</option> <option value="Follow Up">Follow Up</option> </select> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="visit_name">Visit Label<span class="required"><font color="red">*</font></span></label> <input required type="text" class="form-control" id="visit_name" name="visit_names[]"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="days_from_first_visit">Days from 1st Visit<span class="required"><font color="red">*</font></span></label> <input required type="text" class="form-control" id="days_from_first_visit" name="days_from_first_visit[]"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="plus_window_period">Window Period (+)<span class="required"><font color="red">*</font></span></label> <input required type="text" class="form-control" id="plus_window_period" name="plus_window_periods[]"> </div> </div> <div class="col-md-2"> <div class="form-group"> <label for="minus_window_period">Window Period (-)<span class="required"><font color="red">*</font></span></label> <input required type="text" class="form-control" id="minus_window_period" name="minus_window_periods[]"> </div> </div> <div class="col-md-2"> <a id="'+i+'" style="margin-top: 30px;" class="btn btn-sm btn-danger btn_remove_visit"><i class="fas fa-minus-circle"></i> Remove Visit</a> </div> </div>';

            $('#dynamic_visits').append(visit_div);
        });

        $(document).on('click', '.btn_remove_visit', function() {
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Create Visits for Project </h4>
        </div>
   

        <div class="card-body">
            <form action="<?php echo e(route('visits.storeVisitsForProject', $project->id)); ?>" method="post">
                <?php echo csrf_field(); ?>


                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-left">Project Name<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input disabled id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                name="name" value="<?php echo e($project->name); ?>" required autocomplete="name" autofocus >
                        <?php $__errorArgs = ['name'];
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
                    <label for="visit_1_label" class="col-md-3 col-form-label text-md-left">Randomization visit Label<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-7">
                        <input id="visit_1_label" type="text" class="form-control <?php $__errorArgs = ['visit_1_label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                name="visit_1_label" value="<?php echo e($project->visit_1_label); ?>" required placeholder="Please enter a name used by your Project for Visit 1, e.g: Baseline" autofocus >
                        <?php $__errorArgs = ['visit_1_label'];
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
                    <div class="col-md-2">
                        <a class="btn btn-success float-right" id="add_visit"><i class="fas fa-plus-circle"></i> Add Visit</a>
                    </div>
                </div>
                <br>

                <div id="dynamic_visits">

                </div>


                <!-- <div style="border: 2px grey solid; border-radius: 10px;" class="form-group row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="visit_name">Visit 2 Label<span class="required"><font color="red">*</font></span></label>
                            <input required type="text" class="form-control" id="visit_name" name="visit_names[]">
                        </div>  
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="days_from_first_visit">No. of days from 1st Visit<span class="required"><font color="red">*</font></span></label>
                            <input required type="text" class="form-control" id="days_from_first_visit" name="days_from_first_visit[]">
                        </div>  
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="visit_type">Visit Type<span class="required"><font color="red">*</font></span></label>
                            <select name="visit_types[]" class="form-control <?php $__errorArgs = ['visit_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="visit_type" onchange="visit_type_change(this)">
                                <option selected value="Regular">Regular</option>
                                <option value="Follow Up">Follow Up</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="plus_window_period">Window Period (+)<span class="required"><font color="red">*</font></span></label>
                            <input required type="text" class="form-control" id="plus_window_period" name="plus_window_periods[]">
                        </div>  
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="minus_window_period">Window Period (-)<span class="required"><font color="red">*</font></span></label>
                            <input required type="text" class="form-control" id="minus_window_period" name="minus_window_periods[]">
                        </div>  
                    </div>

                    <div class="col-md-2">
                        <a style="margin-top: 30px;" class="btn btn-danger btn_remove_visit" href=""><i class="fas fa-minus-circle"></i> Remove Visit</a>
                    </div>
                </div> -->


                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-6">
                    <a class="pull-left btn btn-primary" href="<?php echo e(url()->previous()); ?>">Back</a>
                        <button type="submit" class="btn btn-success">
                            Save Visits
                        </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>      


           
<?php $__env->stopSection(); ?>
	
	
	
	

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/visits/createForProject.blade.php ENDPATH**/ ?>