
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
                <h5 class="card-title text-primary text-white">Hello, <strong>John!</strong></h5>
                <p class="card-text text-white pb-2 pt-1">Hope you're doing fine today. 
                    <br>You have 14 Appointment visits set for today
                </p>
                <a href="#" class="text-white">View today's appointments</a> 
            </div>               
        </div>

        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('home.scheduled-visits')->html();
} elseif ($_instance->childHasBeenRendered('gzB1r28')) {
    $componentId = $_instance->getRenderedChildComponentId('gzB1r28');
    $componentTag = $_instance->getRenderedChildComponentTagName('gzB1r28');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('gzB1r28');
} else {
    $response = \Livewire\Livewire::mount('home.scheduled-visits');
    $html = $response->html();
    $_instance->logRenderedChild('gzB1r28', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
} elseif ($_instance->childHasBeenRendered('vczx9z5')) {
    $componentId = $_instance->getRenderedChildComponentId('vczx9z5');
    $componentTag = $_instance->getRenderedChildComponentTagName('vczx9z5');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('vczx9z5');
} else {
    $response = \Livewire\Livewire::mount('home.weekly-appointments');
    $html = $response->html();
    $_instance->logRenderedChild('vczx9z5', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/home.blade.php ENDPATH**/ ?>