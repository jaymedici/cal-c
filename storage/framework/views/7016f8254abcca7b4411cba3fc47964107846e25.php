
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
    $html = \Livewire\Livewire::mount('appointments.view-appointments', ['projectId' => $projectId])->html();
} elseif ($_instance->childHasBeenRendered('Ie5x63w')) {
    $componentId = $_instance->getRenderedChildComponentId('Ie5x63w');
    $componentTag = $_instance->getRenderedChildComponentTagName('Ie5x63w');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Ie5x63w');
} else {
    $response = \Livewire\Livewire::mount('appointments.view-appointments', ['projectId' => $projectId]);
    $html = $response->html();
    $_instance->logRenderedChild('Ie5x63w', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/appointments/viewAppointments.blade.php ENDPATH**/ ?>