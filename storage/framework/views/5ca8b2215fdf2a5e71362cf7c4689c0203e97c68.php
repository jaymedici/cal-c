
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
    $html = \Livewire\Livewire::mount('screening.view-screenings', ['projectId' => $projectId])->html();
} elseif ($_instance->childHasBeenRendered('dvVCSN0')) {
    $componentId = $_instance->getRenderedChildComponentId('dvVCSN0');
    $componentTag = $_instance->getRenderedChildComponentTagName('dvVCSN0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('dvVCSN0');
} else {
    $response = \Livewire\Livewire::mount('screening.view-screenings', ['projectId' => $projectId]);
    $html = $response->html();
    $_instance->logRenderedChild('dvVCSN0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/screening/viewScreenings.blade.php ENDPATH**/ ?>