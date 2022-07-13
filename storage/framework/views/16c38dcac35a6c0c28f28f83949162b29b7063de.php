
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
} elseif ($_instance->childHasBeenRendered('CbKvDyE')) {
    $componentId = $_instance->getRenderedChildComponentId('CbKvDyE');
    $componentTag = $_instance->getRenderedChildComponentTagName('CbKvDyE');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('CbKvDyE');
} else {
    $response = \Livewire\Livewire::mount('visits.view-visits');
    $html = $response->html();
    $_instance->logRenderedChild('CbKvDyE', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?> 
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/participantVisits/viewVisits.blade.php ENDPATH**/ ?>