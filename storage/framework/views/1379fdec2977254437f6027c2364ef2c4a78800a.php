<div>
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">Appointments set for this Week</h3>
            <div class="card-tools">
            </div>
        </div>

        <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php $__currentLoopData = $appointmentsThisWeek; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="item">
                    <div class="product-img">
                    <h4><?php echo e(substr(\Carbon\Carbon::parse($appointment->appointment_date_time)->format('l'), 0, 3)); ?></h4>
                    </div>
                    <div class="product-info">
                    <a href="<?php echo e(route('appointments.viewAppointment', $appointment->id)); ?>" class="product-title"><?php echo e($appointment->participant_id); ?>

                    <?php if(isset($appointment->participant_visit_id)): ?>
                    <span class="badge badge-info float-right">Regular</span></a>
                    <span class="product-description">
                    Coming for <?php echo e($appointment->participantVisit->visit->visit_name); ?> Visit
                    </span>
                    <?php elseif(isset($appointment->screening_id)): ?>
                    <span class="badge badge-warning float-right">Screening</span></a>
                    <span class="product-description">
                    coming for Screening
                    </span>
                    <?php endif; ?>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        
        <div class="card-footer text-center">
            <a href="/appointments" class="uppercase">View All Appointments</a>
        </div>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/home/weekly-appointments.blade.php ENDPATH**/ ?>