
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_header'); ?>
  <!--  <h1 class="m-0 text-dark">Dashboard</h1>-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div id="carouselExampleControls" class="carousel slide col-12" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-interval="8000">
        <div class="row" style="background-color:white;">
                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;</span>
                        <h4><?php echo e($projectsAssignedCount); ?></h4>
                        <span class="description-text">PROJECTS ASSIGNED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4>20</h4>
                        <span class="description-text">SCREENED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4>15</h4>
                        <span class="description-text">ENROLLED</span>
                    </div>
                </div>
            </div>
        </div>
        <?php $__currentLoopData = $projectsAssigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item" data-interval="8000">
            <div class="row" style="background-color:white;">
                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fa fa-folder" aria-hidden="true"></i>&nbsp;</span>
                        <h4><?php echo e($project->name); ?></h4>
                        <span class="description-text">PROJECT</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4><?php echo e($numberOfParticipantsScreened[$project->id]); ?></h4>
                        <span class="description-text">SCREENED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4><?php echo e($numberOfParticipantsEnrolled[$project->id]); ?></h4>
                        <span class="description-text">ENROLLED</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
    </div>
    
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-8">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('home.scheduled-visits')->html();
} elseif ($_instance->childHasBeenRendered('tML8gGM')) {
    $componentId = $_instance->getRenderedChildComponentId('tML8gGM');
    $componentTag = $_instance->getRenderedChildComponentTagName('tML8gGM');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('tML8gGM');
} else {
    $response = \Livewire\Livewire::mount('home.scheduled-visits');
    $html = $response->html();
    $_instance->logRenderedChild('tML8gGM', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>  
    </div>

    <div class="col-md-4">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('home.weekly-appointments')->html();
} elseif ($_instance->childHasBeenRendered('hPFA0Cm')) {
    $componentId = $_instance->getRenderedChildComponentId('hPFA0Cm');
    $componentTag = $_instance->getRenderedChildComponentTagName('hPFA0Cm');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('hPFA0Cm');
} else {
    $response = \Livewire\Livewire::mount('home.weekly-appointments');
    $html = $response->html();
    $_instance->logRenderedChild('hPFA0Cm', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    </div>

    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/home.blade.php ENDPATH**/ ?>