
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
                                <td><a class="btn btn-info btn-sm" data-toggle="modal" data-target="#SiteUsersModal<?php echo e($site->id); ?>">Add Users</a></td>
                                
                                <!-- Add Users to Site Modal -->
                                <div class="modal fade" id="SiteUsersModal<?php echo e($site->id); ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Users to <?php echo e($site->site_name); ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo e(route('site.addUsersToSite', $site->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="users">Select Users to add</label>
                                            </div>
                                            <div class="row">
                                                <select name="users[]" class="users-multiple" style="width: 100%" multiple>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </select>
                                                <?php $__errorArgs = ['users'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Add Users</button>
                                    </div>
                                        </form>
                                    </div>
                                </div>
                                </div> 
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