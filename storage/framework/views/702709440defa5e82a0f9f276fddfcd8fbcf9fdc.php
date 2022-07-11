
<?php $__env->startSection('css'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $(window).on('load', function() {
        participant_type_change(document.getElementById("participant_type"));
        screening_outcome_change(document.getElementById("screening_outcome"));
        
    });

    function participant_type_change(obj)
    {
        //console.log(obj);
        var participant_id_div = document.getElementById("participant_id_div");
        var participant_id_select_div = document.getElementById("participant_id_select_div");

        if (obj.value == 'New')
        {
            participant_id_div.style.display = "block";
            participant_id_select_div.style.display = "none";
        }
        else if (obj.value == 'Returning')
        {
            participant_id_select_div.style.display = "block";
            participant_id_div.style.display = "none";
        }
        else
        {
            participant_id_div.style.display = "none";
            participant_id_select_div.style.display = "none";
        }
    }

    function screening_outcome_change(obj)
    {
        //console.log(obj);
        var next_screening_date_div = document.getElementById("next_screening_date_div");

        if (obj.value == 'Continue Screening')
        {
            next_screening_date_div.style.display = "block";
        }
        else
        {
            next_screening_date_div.style.display = "none";
        }
    }

    function project_selected(obj)
    {
        var projectId = $(obj).val();

        if(projectId)
        {
            $.ajax(
                {
                    type:"GET",
                    url:"<?php echo e(url('screening/getScreeningTypes')); ?>/"+projectId,
                    success:function(res){
                        console.log(res);
                        if(res)
                        {
                            $('#screening_label').empty();
                            $('#screening_label').append('<option value="Screening" selected>Screening</option>');
                            $.each(res,function(key,value)
                            {
                                $('#screening_label').append('<option value="'+value+'">'+value+'</option>');
                            });
                        }
                else {
                    $('#screening_label').empty();
                    $("#screening_label").append('<option value="Screening" selected>Screening</option>'); 
                }
                    }
                });

                $.ajax(
                {
                    type:"GET",
                    url:"<?php echo e(url('screening/getScreeningReturningParticipants')); ?>/"+projectId,
                    success:function(res){
                        console.log(res);
                        if(res)
                        {
                            $('#participant_id_select').empty();
                            $('#participant_id_select').append('<option disabled selected value="">Please select the returning Participant</option>');
                            $.each(res,function(key,value)
                            {
                                $('#participant_id_select').append('<option value="'+value+'">'+value+'</option>');
                            });
                        }
                else {
                    $('#participant_id_select').empty();
                    $("#participant_id_select").append('<option disabled selected value="">Please select the returning Participant</option>'); 
                }
                    }
                });
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Screen Patient </h4>
        </div>
   

        <div class="card-body">
            <form action="<?php echo e(route('screening.store')); ?>" method="post">
                <?php echo csrf_field(); ?>


                <div class="form-group row">
                    <label for="project_id" class="col-md-3 col-form-label text-md-left">Project<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="project_id" class="form-control <?php $__errorArgs = ['project_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="project_id" onchange="project_selected(this)">
                            <option disabled selected value="">Please select a Project</option>
                            <?php $__currentLoopData = $projectsWithScreening; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="site_id" class="col-md-3 col-form-label text-md-left">Site<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="site_id" class="form-control <?php $__errorArgs = ['site_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="site_id">
                            <option disabled selected value="">Please select Site</option>
                            <?php $__currentLoopData = $assignedSites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($site->id); ?>"><?php echo e($site->site_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="screening_label" class="col-md-3 col-form-label text-md-left">Screening Label<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="screening_label" class="form-control <?php $__errorArgs = ['screening_label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="screening_label">
                            <option selected value="Screening">Screening</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="participant_type" class="col-md-3 col-form-label text-md-left">Participant type<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="participant_type" class="form-control <?php $__errorArgs = ['participant_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="participant_type" onchange="participant_type_change(this)">
                            <option disabled selected value="">Please select the type of Participant you're screening</option>
                            <option value="New">New Participant</option>
                            <option value="Returning">Returning Participant</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                    
                    </div>
                    <div class="form-group col-md-9 row" id="participant_id_div" style="display: none" >
                        <label for="participant_id" class=" col-md-2 col-form-label text-md-left">Participant ID<span class="required"><font color="red">*</font></span></label>
                        <div class="col-md-7">
                            <input id="participant_id" type="text" class="form-control <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    name="participant_id" value="<?php echo e(old('participant_id')); ?>" autocomplete="participant_id" autofocus >
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
                </div>
                
                
                <div class="row">
                    <div class="col-md-3">
                    
                    </div>
                    <div id="participant_id_select_div" style="display: none" class="form-group col-md-9 row">
                        <label for="participant_id_select" class="col-md-3 col-form-label text-md-left">Select Participant<span class="required"><font color="red">*</font></span></label>
                        <div class="col-md-6">
                            <select name="participant_id_select" class="participant_id_select form-control <?php $__errorArgs = ['participant_id_select'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="participant_id_select">
                                <option disabled selected value="">Please select the returning Participant</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="screening_date" class="col-md-3 col-form-label text-md-left">Screening Date<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input required id="screening_date" type="date" class="form-control <?php $__errorArgs = ['screening_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                name="screening_date" value="<?php echo e(old('screening_date')); ?>" autocomplete="screening_date" autofocus >
                        <?php $__errorArgs = ['screening_date'];
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
                    <label for="screening_outcome" class="col-md-3 col-form-label text-md-left">Screening Outcome<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="screening_outcome" class="form-control <?php $__errorArgs = ['screening_outcome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="screening_outcome" onchange="screening_outcome_change(this)">
                            <option disabled selected value="">Please select the outcome after screening</option>
                            <option value="Continue Screening">Continue Screening</option>
                            <option value="Enrol">Enrol</option>
                            <option value="Screen Failure">Screen Failure</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                    
                    </div>
                    <div id="next_screening_date_div" style="display: none" class="form-group col-md-9 row">
                        <label for="next_screening_date" class="col-md-3 col-form-label text-md-left">Next Screening Date<span class="required"><font color="red">*</font></span></label>
                        <div class="col-md-6">
                            <input id="next_screening_date" type="date" class="form-control <?php $__errorArgs = ['next_screening_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    name="next_screening_date" value="<?php echo e(old('next_screening_date')); ?>" autocomplete="next_screening_date" autofocus >
                            <?php $__errorArgs = ['next_screening_date'];
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
                </div>

                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-5">
                    <a class="pull-left btn btn-primary" href="<?php echo e(url()->previous()); ?>">Back</a>
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/screening/create.blade.php ENDPATH**/ ?>