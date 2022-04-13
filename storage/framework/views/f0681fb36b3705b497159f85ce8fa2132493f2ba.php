<div>
<div class="row">
    <div class="card col-md-12">
        <div class="card-header">
            <h4 class="card-title">Participant Visit Schedule for <?php echo e($project->name); ?></h4>
            
            <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 250px;">
                <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search Participant...">
                <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
        </div>
        </div>

        <div class="card-body">
            <div class="table-responsive table-bordered table-striped table-hover ">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="table-active">Participant ID</th>
                            <?php $__currentLoopData = $project->visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up"): ?>
                                <th class="table-active" colspan="5"><?php echo e($visit->visit_name); ?></th>
                                <?php else: ?>
                                <th class="table-active"><?php echo e($visit->visit_name); ?></th>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>

                        <tr>
                            <th class="table-secondary"></th>
                            <?php $__currentLoopData = $project->visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up"): ?>
                                <th class="table-secondary">Window Min</th>
                                <th class="table-secondary">Calculated</th>
                                <th class="table-secondary">Actual</th>
                                <th class="table-secondary">Window Max</th>
                                <th class="table-secondary">Status</th>
                                <?php else: ?>
                                <th class="table-secondary">Date</th>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr wire:loading.remove>
                            <td class="table-primary"><strong><?php echo e($participant); ?></strong></td>
                            <!-- <?php $__currentLoopData = $visitSchedule[$participant]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                            <?php $__currentLoopData = $project->visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up"): ?>
                                <td> <?php echo e(\Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->window_start_date)->format('d M, Y')); ?> </td>
                                <td> <?php echo e(\Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->visit_date)->format('d M, Y')); ?> </td>
                                <td> <?php echo e($visitSchedule[$participant][$visit->id]->actual_visit_date); ?> </td>
                                <td> <?php echo e(\Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->window_end_date)->format('d M, Y')); ?> </td>
                                    <?php if( $visitSchedule[$participant][$visit->id]->visit_status == "Pending"): ?>
                                    <td class="bg-info"> <?php echo e($visitSchedule[$participant][$visit->id]->visit_status); ?> </td>
                                    <?php elseif( $visitSchedule[$participant][$visit->id]->visit_status == "Completed"): ?>
                                    <td class="bg-success"> <?php echo e($visitSchedule[$participant][$visit->id]->visit_status); ?> </td>
                                    <?php elseif( $visitSchedule[$participant][$visit->id]->visit_status == "Missed"): ?>
                                    <td class="bg-danger"> <?php echo e($visitSchedule[$participant][$visit->id]->visit_status); ?> </td>
                                    <?php endif; ?>
                                <?php else: ?>
                                <td class="table-success"> <?php echo e(\Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->visit_date)->format('d M, Y')); ?> </td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="100%">No Participants Found...</td>
                        </tr>   
                        <?php endif; ?>
         
                    </tbody>

                </table>

                <div wire:loading>
                    Processing your query...
                </div>

                <div class="float-right">
                    <?php echo e($participants->links()); ?>

                </div>
                
            </div>
        </div>
    </div>
</div>  
</div>
<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/participant-visits/view-all-participant-visits.blade.php ENDPATH**/ ?>