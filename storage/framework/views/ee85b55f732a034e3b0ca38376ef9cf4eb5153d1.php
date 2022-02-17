
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="card card-primary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Participant Visit Schedule for <?php echo e($project->name); ?></h4>
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
                        <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
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
                                    <?php elseif( $visitSchedule[$participant][$visit->id]->visit_status == "Missed Visit"): ?>
                                    <td class="bg-danger"> <?php echo e($visitSchedule[$participant][$visit->id]->visit_status); ?> </td>
                                    <?php endif; ?>
                                <?php else: ?>
                                <td class="table-success"> <?php echo e(\Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->visit_date)->format('d M, Y')); ?> </td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>   
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/participantVisits/projectVisitsIndex.blade.php ENDPATH**/ ?>