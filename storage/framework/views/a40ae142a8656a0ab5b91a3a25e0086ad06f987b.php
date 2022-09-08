
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
} elseif ($_instance->childHasBeenRendered('q0AbHu8')) {
    $componentId = $_instance->getRenderedChildComponentId('q0AbHu8');
    $componentTag = $_instance->getRenderedChildComponentTagName('q0AbHu8');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('q0AbHu8');
} else {
    $response = \Livewire\Livewire::mount('appointments.view-appointments', ['projectId' => $projectId]);
    $html = $response->html();
    $_instance->logRenderedChild('q0AbHu8', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cal-c\resources\views/appointments/viewAppointments.blade.php ENDPATH**/ ?>