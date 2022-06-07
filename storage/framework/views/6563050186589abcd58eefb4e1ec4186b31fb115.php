<div>
    <div class="mb-3">
        <?php $__currentLoopData = $assignedUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-inline-item text-center">
            <img src="<?php echo e(asset('img/user-avatar.png')); ?>" alt="Avatar" height="50">
            <br> <?php echo e(strtok($user->name, " ")); ?>

        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="float-right"> <?php echo e($assignedUsers->links()); ?> </div>
    
</div>
<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/projects/view-assigned-users.blade.php ENDPATH**/ ?>