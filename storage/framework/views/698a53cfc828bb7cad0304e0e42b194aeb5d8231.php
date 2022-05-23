
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('visits.create-visits-for-project', ['project' => $project])->html();
} elseif ($_instance->childHasBeenRendered('WfikPhp')) {
    $componentId = $_instance->getRenderedChildComponentId('WfikPhp');
    $componentTag = $_instance->getRenderedChildComponentTagName('WfikPhp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('WfikPhp');
} else {
    $response = \Livewire\Livewire::mount('visits.create-visits-for-project', ['project' => $project]);
    $html = $response->html();
    $_instance->logRenderedChild('WfikPhp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/visits/create.blade.php ENDPATH**/ ?>