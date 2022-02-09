<?php if(isset($errors) && count($errors) > 0): ?>
     <div class="alert alert-dismissable alert-danger col-md-9 col-lg-9">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true"> &times; </span>
          </button>
     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <li><strong><?php echo $error; ?> </strong></li>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/partials/errors.blade.php ENDPATH**/ ?>