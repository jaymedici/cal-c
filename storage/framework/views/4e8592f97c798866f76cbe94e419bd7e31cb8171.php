<div class="col-md-12">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <div class="card-title mr-4">
                <h5>All Participant Visits</h5>
            </div>
            <div class="card-title mr-2">
                <div class="input-group input-group-sm">
                    <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search Participant...">
                    <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </div>
            <div class="card-title form-group mr-2">
                <select wire:model="visitStatus" class="form-control-sm" name="">
                    <option selected value="">Status Filter</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Missed">Missed</option>
                </select>
            </div>
            <div class="card-title mr-2">
                <a wire:click="clearFilters" href="#" class="btn btn-sm btn-secondary"> <i class="fa fa-eraser"></i> Clear Filters</a>
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
                            <?php else: ?>
                            <td></td>
                            <?php endif; ?>
                            <td>
                                <?php if($participantVisit->visit_status == "Pending"): ?>
                                   <span class="text-bold text-info"><?php echo e($participantVisit->visit_status); ?></span> 
                                <?php elseif($participantVisit->visit_status == "Missed"): ?>
                                    <span class="text-bold text-danger"><?php echo e($participantVisit->visit_status); ?></span> 
                                <?php elseif($participantVisit->visit_status == "Completed"): ?>
                                    <span class="text-bold text-success"><?php echo e($participantVisit->visit_status); ?></span> 
                                <?php endif; ?> 
                            </td>
                            
                            <?php if($participantVisit->VisitStatusCanBeEdited()): ?>
                            <td><a wire:click='editParticipantVisit(<?php echo e($participantVisit); ?>)' class="btn btn-sm btn-warning">Edit Visit</a></td> 
                            <?php endif; ?>         
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

    <!-- Edit Visit Modal -->
    <?php echo $__env->make('modals.editParticipantVisit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/visits/view-visits.blade.php ENDPATH**/ ?>