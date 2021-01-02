<?php ( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') ); ?>

<?php if(config('adminlte.use_route_url', false)): ?>
    <?php ( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' ); ?>
<?php else: ?>
    <?php ( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' ); ?>
<?php endif; ?>

<?php $__env->startSection('auth_header', __('adminlte::adminlte.password_reset_message')); ?>

<?php $__env->startSection('auth_body'); ?>
    <form action="<?php echo e($password_reset_url); ?>" method="post">
        <?php echo e(csrf_field()); ?>


        
        <input type="hidden" name="token" value="<?php echo e($token); ?>">

        
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                   value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('adminlte::adminlte.email')); ?>" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope <?php echo e(config('adminlte.classes_auth_icon', '')); ?>"></span>
                </div>
            </div>
            <?php if($errors->has('email')): ?>
                <div class="invalid-feedback">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="input-group mb-3">
            <input type="password" name="password"
                   class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                   placeholder="<?php echo e(__('adminlte::adminlte.password')); ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock <?php echo e(config('adminlte.classes_auth_icon', '')); ?>"></span>
                </div>
            </div>
            <?php if($errors->has('password')): ?>
                <div class="invalid-feedback">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control <?php echo e($errors->has('password_confirmation') ? 'is-invalid' : ''); ?>"
                   placeholder="<?php echo e(trans('adminlte::adminlte.retype_password')); ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock <?php echo e(config('adminlte.classes_auth_icon', '')); ?>"></span>
                </div>
            </div>
            <?php if($errors->has('password_confirmation')): ?>
                <div class="invalid-feedback">
                    <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                </div>
            <?php endif; ?>
        </div>

        
        <button type="submit" class="btn btn-block <?php echo e(config('adminlte.classes_auth_btn', 'btn-flat btn-primary')); ?>">
            <span class="fas fa-sync-alt"></span>
            <?php echo e(__('adminlte::adminlte.reset_password')); ?>

        </button>

    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::auth.auth-page', ['auth_type' => 'login'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/vendor/adminlte/auth/passwords/reset.blade.php ENDPATH**/ ?>