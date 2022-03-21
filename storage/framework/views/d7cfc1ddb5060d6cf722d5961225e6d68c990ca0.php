
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
                    <h4 class="box-title">Sites</h4>
                </div>

                <div class="col-md-4">
                    <a class="float-right btn btn-success " href="/sites/create"><i class="fas fa-plus-circle"></i> Register New Site</a>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="card-body" style="">
                
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Site Name</th>
                                <th>District</th>
                                <th>Region</th>
                                <th>Country</th>
                                <th>Number of Users</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $allSites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($site->site_name); ?></td>
                                <td><?php echo e($site->district); ?></td>
                                <td><?php echo e($site->region); ?></td>
                                <td><?php echo e($site->country); ?></td>
                                <td><?php echo e($site->users_count); ?></td>
                                
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($allSites->links()); ?>

                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/sites/index.blade.php ENDPATH**/ ?>