<div class="col-md-12">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <div class="card-title mr-4">
                <h5>All Participant Visits</h5>
            </div>
        </div>
   

        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Site</th>
                        <th>Participant ID</th>
                        <th>Visit</th>
                        <th>Window Dates</th>
                        <th>Appointment Date</th>
                        <th>Visit Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $participantVisits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participantVisit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr wire:loading.remove>
                            <td><?php echo e($participantVisit->project->name); ?> </td>
                            <td><?php echo e($participantVisit->site->site_name); ?> </td>
                            <td><?php echo e($participantVisit->participant_id); ?> </td>
                            <td><?php echo e($participantVisit->visit->visit_name); ?></td>
                            <td><?php echo e($participantVisit->window_start_date_formatted); ?> - <br> <?php echo e($participantVisit->window_end_date_formatted); ?> </td>
                            <?php if($participantVisit->appointment()->exists()): ?>
                            <td><?php echo e($participantVisit->appointment->appointment_date_time_formatted); ?></td>
                            <?php else: ?>
                            <td><i>No set Appt...</i></td>
                            <?php endif; ?>
                            <td><?php echo e($participantVisit->visit_status); ?> </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8">No result found...</td>
                        </tr>
                    <?php endif; ?> 
                </tbody>
                
            </table>
            <div wire:loading>
                Processing your query...
            </div>
            <div class="float-right">
                <?php echo $participantVisits->links(); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/visits/view-visits.blade.php ENDPATH**/ ?>