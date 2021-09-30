

<?php $__env->startSection('css'); ?>
    <style type="text/css">
        .required::after {
            content: "*";
            color: red;
        }

        .small-text {
            font-size: small;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


      <?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('partials.errors2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div>
   
    <div class="row">
        <div class="card border-info col-md-12 col-lg-12">
            <div class="card-body">

                <div class="row">     

                    <div class="card col-md-6 col-lg-6 mr-5 small-text">
                    <h4 style="text-align:center">Edit User information</h4>
                        <div class="card-body">


                        <form action="<?php echo e(route('user.update',[$User->id])); ?>" method="post">
                        <?php echo csrf_field(); ?>


                              <input type="hidden" name="_method" value="put">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Full Name<span class="required"></span></label>
                            <div class="col-md-6">
                                <input id="name" 
                                       type="text" 
                                       class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="name" 
                                       value="<?php echo e($User->name); ?>" 
                                       required autocomplete="name" 
                                       autofocus >
                                <?php $__errorArgs = ['name'];
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

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">Department<span class="required"></span></label>
                            <div class="col-md-6">
                            <select id="department" required name="department" class="form-control <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"/>
                                  <option value="<?php echo e($User->department); ?>"><?php echo e($User->department); ?></option>
                                  <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($department->name); ?>"><?php echo e($department->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
                                       <?php $__errorArgs = ['department'];
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


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Address<span class="required"></span></label>
                            <div class="col-md-6">
                                <input id="email" 
                                       type="email" 
                                       class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="email" 
                                       value="<?php echo e($User->email); ?>" 
                                       required autocomplete="email" 
                                       autofocus >
                                <?php $__errorArgs = ['email'];
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
                  
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">User Name<span class="required"></span></label>
                            <div class="col-md-6">
                                <input id="username" 
                                       type="text" 
                                       class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       name="username" 
                                       value="<?php echo e($User->username); ?>" 
                                       required autocomplete="username" 
                                       autofocus >
                                <?php $__errorArgs = ['username'];
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

                        <div class="form-group row">
                        <label for="user_active" class="col-md-4 col-form-label text-md-right">User Active</label>
                            <div class="col-md-6">  
                            
                            <select id="user_active" data-placeholder="Select a Roles" class="form-control tagsselector" name="user_active">  
                                        <option value="<?php echo e($User->user_active); ?>"> <?php echo e($User->user_active); ?></option>
                                        <option value="Yes">Yes</option>
                                        <option value="No"> No</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="userRole" class="col-md-4 col-form-label text-md-right">User Role</label>
                            <div class="col-md-6">  
                            
                            <select id="userRole" data-placeholder="Select a Roles" class="form-control tagsselector" name="roles[]" multiple="multiple">
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>"  <?php echo e($User->roles->contains($role->id) ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            </div>
                        </div>
                                <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10">
                                            <input class="btn btn-success" id="submit" type="submit" value="Save">
                                        </div>
                                </div>
                            </form>
                           
                        </div>
                    </div>


                    <div class="card col-md-5 col-lg-5">
                    <h5 class="card-header">Add Projects</h5>
                   
                        <div class="card-body">

                        <form action="/addprojecttouser" method="get">
                        <input  type="hidden" name="user_id" value="<?php echo e($User->id); ?>">
                        <table class="table">
                                    <thead>
                                    <tr>
                                    <th>  Project Name</th>
                                    <th>
                           <select class="form-control" required name="project_id">
                                <option value="<?php echo e(old('project_id')); ?>"><?php echo e(old('staff_id')); ?></option>
                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select></th>
                           <th>
                           <input class="btn btn-success" id="submit" type="submit" value="Add New Project">
                           </th>
                           </tr></thead> </table>
                                    
                        </form>

                        <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Project ID</th>
                                        <th>Project Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $userProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userProject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                        <td><?php echo e($userProject->project_id); ?> </td>
                                        <td> <?php echo e($userProject->project->name); ?></td>
                                        <td>
                                        <form action="/removeprojecttouser" method="get">
                                            <input  type="hidden" name="user_id" value="<?php echo e($User->id); ?>">
                                            <input  type="hidden" name="project_id" value="<?php echo e($userProject->project_id); ?>">
                                            <input onclick='return confirm("Are you sure You want to remove this record?? Click Ok to continue or Click Cancel to Cancel")' class="btn btn-sm btn-danger" id="submit" type="submit" value="Remove">                     
                                        </form>
                                        </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    </table>
                            </div>

                        </div> 
                    </div>






                    </div>
                </div>
            </div>
        </div>
   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/users/edit.blade.php ENDPATH**/ ?>