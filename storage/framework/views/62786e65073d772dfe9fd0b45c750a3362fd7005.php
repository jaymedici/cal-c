<?php $attributes = $attributes->exceptProps(['type' => 'secondary']); ?>
<?php foreach (array_filter((['type' => 'secondary']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div <?php echo e($attributes->merge([
    'class' => 'col-md-12 card card-outline card-'.$type])); ?>

    >

    <div class="card-body">
        <?php echo e($slot); ?>

    </div>
</div><?php /**PATH C:\xampp\htdocs\cal-c\resources\views/components/panel.blade.php ENDPATH**/ ?>