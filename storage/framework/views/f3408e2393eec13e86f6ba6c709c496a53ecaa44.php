
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<br>
<div class="row">
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('users.view-users')->html();
} elseif ($_instance->childHasBeenRendered('YG3OmzV')) {
    $componentId = $_instance->getRenderedChildComponentId('YG3OmzV');
    $componentTag = $_instance->getRenderedChildComponentTagName('YG3OmzV');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('YG3OmzV');
} else {
    $response = \Livewire\Livewire::mount('users.view-users');
    $html = $response->html();
    $_instance->logRenderedChild('YG3OmzV', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/users/index.blade.php ENDPATH**/ ?>