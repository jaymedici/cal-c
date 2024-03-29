<div class="col-md-12">
    <div class="card card-outline card-secondary">
        <div class="card-header">
            <div class="card-title mr-4">
                <h5>Participant Appointments</h5>
            </div>
            <div class="card-title mr-4">
                <a wire:click='createAppointment()' class="btn btn-sm btn-success"> <i class="fa fa-plus-circle"></i> Create Appointment</a>
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
    
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Participant ID</th>
                        <th>Date & Time</th>
                        <th>Visit Type</th>
                        <th>Created By</th>
                        <th>Visit Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
    
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr wire:loading.remove>
                            <td>
                                <?php echo e($appointment->participant_id); ?>

                                <?php if($appointment->participantVisit): ?>
                                    <?php if(!$appointment->participantVisit->project->studyArms->isEmpty()): ?>
                                    (<?php echo e($appointment->participantVisit->participant->studyArm->name); ?>)
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($appointment->appointment_date_time); ?></td>
                            <?php if(!empty($appointment->participant_visit_id)): ?>
                            <td><?php echo e($appointment->participantVisit->visit->visit_name); ?></td>
                            <?php else: ?>
                                <?php if(!empty($appointment->screening->screening_label)): ?>
                                <td><?php echo e($appointment->screening->screening_label); ?></td>
                                <?php else: ?>
                                <td><?php echo e($appointment->screening_visit_label); ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                            <td><?php echo e($appointment->updated_by); ?></td>
                            <td>
                                <?php if($appointment->participantVisit->visit_status == "Pending"): ?>
                                   <span class="text-bold text-info"><?php echo e($appointment->participantVisit->visit_status); ?></span> 
                                <?php elseif($appointment->participantVisit->visit_status == "Missed"): ?>
                                    <span class="text-bold text-danger"><?php echo e($appointment->participantVisit->visit_status); ?></span> 
                                <?php elseif($appointment->participantVisit->visit_status == "Completed"): ?>
                                    <span class="text-bold text-success"><?php echo e($appointment->participantVisit->visit_status); ?></span> 
                                <?php endif; ?>
                            </td>
                            <td><a wire:click='editParticipantVisit(<?php echo e($appointment->participantVisit); ?>)' class="btn btn-sm btn-warning">Edit Visit</a></td> 
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">No Result Found... </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
    
            <div wire:loading>
                Processing your query...
            </div>
    
            <div class="d-flex justify-content-end">
            <?php echo $appointments->links(); ?>

            </div>
        </div>
    
        <!-- Appointment Creation Form Modal -->
        <?php echo $__env->make('modals.createAppointment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Edit Visit Modal -->
        <?php echo $__env->make('modals.editParticipantVisit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\cal-c\resources\views/livewire/appointments/view-appointments.blade.php ENDPATH**/ ?>