
<div class="card card-success col-md-6">
        <div class="card-header">
            <h4 class="card-title">Project List</h4>
        </div>
        <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($projects->id); ?></td>
                    <td><?php echo e($projects->name); ?></td>
                    <td><a class="pull-center" href="/projectData/<?php echo e($projects->id); ?>" role="button">View Data</a></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        </div>
    </div>

<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/charts/projects.blade.php ENDPATH**/ ?>