
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
} elseif ($_instance->childHasBeenRendered('yqj0FcA')) {
    $componentId = $_instance->getRenderedChildComponentId('yqj0FcA');
    $componentTag = $_instance->getRenderedChildComponentTagName('yqj0FcA');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('yqj0FcA');
} else {
    $response = \Livewire\Livewire::mount('users.view-users');
    $html = $response->html();
    $_instance->logRenderedChild('yqj0FcA', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/users/index.blade.php ENDPATH**/ ?>