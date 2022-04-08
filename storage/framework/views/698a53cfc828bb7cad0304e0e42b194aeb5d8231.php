
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('visits.create-visits-for-project', ['project' => $project])->html();
} elseif ($_instance->childHasBeenRendered('T0yBQxj')) {
    $componentId = $_instance->getRenderedChildComponentId('T0yBQxj');
    $componentTag = $_instance->getRenderedChildComponentTagName('T0yBQxj');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('T0yBQxj');
} else {
    $response = \Livewire\Livewire::mount('visits.create-visits-for-project', ['project' => $project]);
    $html = $response->html();
    $_instance->logRenderedChild('T0yBQxj', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/visits/create.blade.php ENDPATH**/ ?>