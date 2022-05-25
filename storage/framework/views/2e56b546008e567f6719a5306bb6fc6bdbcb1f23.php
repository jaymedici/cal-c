
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('fullcalendar/main.css')); ?>" rel='stylesheet' />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="card card-outline card-secondary col-md-12">
    <div class="card-header">
            <h4 class="col-md-12" align="center">Visit Schedule & Appointments Calendar </h4>
        </div> 
   
        <div class="card-body">
            <div class="row">
                  <p> <b>Key:</b> <span class="text-primary">Blue</span> = Opening Windows; <span class="text-danger">Red</span> = Closing Windows; <span class="text-success">Green Points</span> = Appointments </p>
            </div>

            <div class="row">
                <?php echo $calendar->calendar(); ?>

                <?php echo $calendar->script(); ?>

            </div> 
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/calendar/show.blade.php ENDPATH**/ ?>