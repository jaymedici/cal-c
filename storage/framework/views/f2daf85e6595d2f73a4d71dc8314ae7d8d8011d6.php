
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
    $html = \Livewire\Livewire::mount('appointments.view-appointments')->html();
} elseif ($_instance->childHasBeenRendered('jSI0DYv')) {
    $componentId = $_instance->getRenderedChildComponentId('jSI0DYv');
    $componentTag = $_instance->getRenderedChildComponentTagName('jSI0DYv');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('jSI0DYv');
} else {
    $response = \Livewire\Livewire::mount('appointments.view-appointments');
    $html = $response->html();
    $_instance->logRenderedChild('jSI0DYv', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/appointments/index.blade.php ENDPATH**/ ?>