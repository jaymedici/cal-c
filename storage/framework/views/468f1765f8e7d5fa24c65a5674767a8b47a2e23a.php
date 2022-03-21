
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
            <h4 class="col-md-12" align="center">Projects with patient visits</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>No. of Visits</th>
                            <th>Enroled Participants</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $projectsWithVisits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($project->name); ?></td>
                            <td><?php echo e($project->include_screening); ?></td>
                            <td>0</td>
                            <td><a href="<?php echo e(route('participantVisits.projectVisitsIndex',$project->id)); ?>">View Participant Visits</a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($projectsWithVisits->links()); ?>

            </div>
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/participantVisits/visitsIndex.blade.php ENDPATH**/ ?>