<?php if(session()->has('success')): ?>
     <div class="alert alert-dismissable alert-success col-md-12 col-lg-12">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true"> &times; </span>
          </button>
       
    <strong><?php echo session()->get('success'); ?> </strong>

     </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\cal-c\resources\views/partials/success.blade.php ENDPATH**/ ?>