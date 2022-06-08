
<?php $__env->startSection('css'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.users-multiple').select2();
    });
</script>
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
                                <th>Site Users</th>
                                <th>Action</th>
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
                                <td><a class="btn btn-info btn-sm" data-toggle="modal" data-target="#AddUsersModal<?php echo e($site->id); ?>">Add Users</a>
                                <a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ViewUsersModal<?php echo e($site->id); ?>">View Users</a></td>
                                <!-- Add Users to Site Modal -->
                                 <?php echo $__env->make('partials.addUsersToSite', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                 <!-- Site Users Modal -->
                                 <?php echo $__env->make('partials.viewSiteUsers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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