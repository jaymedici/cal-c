<div>
    <div class="card card-outline card-success">
        <div class="card-header border-transparent">
            <h3 class="card-title">Scheduled Visits for the coming two Weeks</h3>
            <div class="card-tools">
            </div>

            <div class="card-tools">
            <div class="input-group input-group-sm">
                <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search Participant...">
                <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
        </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Participant ID</th>
                            <th>Visit</th>
                            <th>Window</th>
                            <th>Set Appt</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $scheduledParticipantVisits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participantVisit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($participantVisit->project->name); ?> </td>
                            <td>
                                <?php echo e($participantVisit->participant_id); ?> 
                                <?php if(!$participantVisit->project->studyArms->isEmpty()): ?>
                                    (<?php echo e($participantVisit->participant->studyArm->name); ?>)
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($participantVisit->visit->visit_name); ?></td>
                            <td><?php echo e($participantVisit->window_start_date_formatted); ?> - <br> <?php echo e($participantVisit->window_end_date_formatted); ?> </td>
                            <?php if($participantVisit->appointment()->exists()): ?>
                            <td><?php echo e($participantVisit->appointment->appointment_date_time_formatted); ?></td>
                            <td><a class="btn btn-sm btn-warning" href="#" wire:click.prevent="changeAppointment(<?php echo e($participantVisit); ?>)"> <i class="fa fa-pen-square"></i> Change Appt.</a></td>
                            <?php else: ?>
                            <td><i>No set Appt...</i></td>
                            <td><a class="btn btn-sm btn-primary" href="" wire:click.prevent="setAppointment(<?php echo e($participantVisit); ?>)"> <i class="fa fa-plus-circle"></i> Set Appt.</a></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="float-right">
                <a href="<?php echo e(route('participantVisits.viewVisits')); ?>">View All Visits</a>
            </div>
            <?php echo e($scheduledParticipantVisits->links()); ?>

        </div>

    </div>

    <!-- Set Appointment Modal -->
    <?php echo $__env->make('modals.setAppointment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Change Appointment Modal -->
    <?php echo $__env->make('modals.changeAppointment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/home/scheduled-visits.blade.php ENDPATH**/ ?>