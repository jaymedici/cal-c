
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<br>

<div class="row">
    <div class="card card-secondary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Missed Visits</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Participant</th>
                            <th>Site</th>
                            <th>Visit</th>
                            <th>Date marked missed</th>
                            <th>Marked by</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $missedVisits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $missedVisit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($missedVisit->participant_id); ?></td>
                            <td><?php echo e($missedVisit->site_id); ?></td>
                            <td><?php echo e($missedVisit->visit_id); ?></td>
                            <td><?php echo e($missedVisit->marked_date); ?></td>
                            <td><?php echo e($missedVisit->marked_by); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="float-right">
                <?php echo e($missedVisits->links('pagination::bootstrap-4')); ?>

                </div>
                
            </div>
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/participantVisits/projectMissedVisitsIndex.blade.php ENDPATH**/ ?>