
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
    $html = \Livewire\Livewire::mount('participants.view-enrolled-participants', ['project' => $project])->html();
} elseif ($_instance->childHasBeenRendered('THVGFCT')) {
    $componentId = $_instance->getRenderedChildComponentId('THVGFCT');
    $componentTag = $_instance->getRenderedChildComponentTagName('THVGFCT');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('THVGFCT');
} else {
    $response = \Livewire\Livewire::mount('participants.view-enrolled-participants', ['project' => $project]);
    $html = $response->html();
    $_instance->logRenderedChild('THVGFCT', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/participants/enrolledParticipantsIndex.blade.php ENDPATH**/ ?>