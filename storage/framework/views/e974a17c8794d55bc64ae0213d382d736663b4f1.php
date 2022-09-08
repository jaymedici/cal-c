
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_header'); ?>
  <!--  <h1 class="m-0 text-dark">Dashboard</h1>-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-md-8">
        <div class="card bg-gradient-dark">
            <img class="card-img-top rounded" src="<?php echo e(asset('img/walkway.jpg')); ?>" alt="" height="200" style="object-fit: cover">
            <div class="card-img-overlay d-flex flex-column justify-content-end">
                <h5 class="card-title text-primary text-white">Hello, <strong><?php echo e(strtok(auth()->user()->name, " ")); ?>!</strong></h5>
                <p class="card-text text-white pb-2 pt-1">Hope you're doing fine today. 
                    <br>You have <?php echo e($appointmentsNoToday); ?> Appointment visits set for today
                </p>
                <a href="/appointments" class="text-white">View appointments</a> 
            </div>               
        </div>

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('home.scheduled-visits')->html();
} elseif ($_instance->childHasBeenRendered('MkfpqAf')) {
    $componentId = $_instance->getRenderedChildComponentId('MkfpqAf');
    $componentTag = $_instance->getRenderedChildComponentTagName('MkfpqAf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('MkfpqAf');
} else {
    $response = \Livewire\Livewire::mount('home.scheduled-visits');
    $html = $response->html();
    $_instance->logRenderedChild('MkfpqAf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h4 class="card-title">You are currently assigned to these Projects</h4>
            </div>
            
            <div class="card-body">
                <ul class="list-group list-group-unbordered mb-3">
                    <?php $__currentLoopData = $userAssignedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                       <b> <?php echo e($project->name); ?> </b>  <a href="<?php echo e(route('projects.show', $project->id)); ?>" class="float-right">View Project</a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('home.weekly-appointments')->html();
} elseif ($_instance->childHasBeenRendered('FNi3jCz')) {
    $componentId = $_instance->getRenderedChildComponentId('FNi3jCz');
    $componentTag = $_instance->getRenderedChildComponentTagName('FNi3jCz');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('FNi3jCz');
} else {
    $response = \Livewire\Livewire::mount('home.weekly-appointments');
    $html = $response->html();
    $_instance->logRenderedChild('FNi3jCz', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cal-c\resources\views/home.blade.php ENDPATH**/ ?>