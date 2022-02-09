
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card card-info">
            <div class="card-header with-border row">
                <div class="col-md-8">
                    <h4 class="box-title">Projects</h4>
                </div>

                <div class="col-md-4">
                    <a class="float-right btn btn-success " href="/projects/create"><i class="fas fa-plus-circle"></i> Register New Project</a>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="card-body" style="">
                
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Project Description</th>
                                <th>Includes Screening</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $allProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($project->name); ?></td>
                                <td><?php echo e($project->description); ?></td>
                                <td><?php echo e($project->include_screening); ?></td>
                                <td><a href="<?php echo e(route('projectData', $project->id)); ?>">View Project</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($allProjects->links()); ?>

                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/projects/index.blade.php ENDPATH**/ ?>