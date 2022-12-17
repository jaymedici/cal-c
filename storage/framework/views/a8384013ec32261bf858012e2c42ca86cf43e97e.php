
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
   <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('visits.view-visits')->html();
} elseif ($_instance->childHasBeenRendered('TC6vQ6E')) {
    $componentId = $_instance->getRenderedChildComponentId('TC6vQ6E');
    $componentTag = $_instance->getRenderedChildComponentTagName('TC6vQ6E');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('TC6vQ6E');
} else {
    $response = \Livewire\Livewire::mount('visits.view-visits');
    $html = $response->html();
    $_instance->logRenderedChild('TC6vQ6E', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?> 
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cal-c\resources\views/participantVisits/viewVisits.blade.php ENDPATH**/ ?>