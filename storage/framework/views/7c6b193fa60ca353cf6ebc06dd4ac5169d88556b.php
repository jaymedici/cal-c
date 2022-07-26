
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('participant-visits.view-all-participant-visits', ['projectId' => $projectId])->html();
} elseif ($_instance->childHasBeenRendered('nLZDQfD')) {
    $componentId = $_instance->getRenderedChildComponentId('nLZDQfD');
    $componentTag = $_instance->getRenderedChildComponentTagName('nLZDQfD');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('nLZDQfD');
} else {
    $response = \Livewire\Livewire::mount('participant-visits.view-all-participant-visits', ['projectId' => $projectId]);
    $html = $response->html();
    $_instance->logRenderedChild('nLZDQfD', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/participantVisits/projectVisitsIndex.blade.php ENDPATH**/ ?>