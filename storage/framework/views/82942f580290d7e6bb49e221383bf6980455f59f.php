
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content_header'); ?>
  <!--  <h1 class="m-0 text-dark">Dashboard</h1>-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div id="carouselExampleControls" class="carousel slide col-12" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-interval="8000">
        <div class="row" style="background-color:white;">
                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;</span>
                        <h4><?php echo e($projectsAssignedCount); ?></h4>
                        <span class="description-text">PROJECTS ASSIGNED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4>20</h4>
                        <span class="description-text">SCREENED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4>15</h4>
                        <span class="description-text">ENROLLED</span>
                    </div>
                </div>
            </div>
        </div>
        <?php $__currentLoopData = $projectsAssigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item" data-interval="8000">
            <div class="row" style="background-color:white;">
                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fa fa-folder" aria-hidden="true"></i>&nbsp;</span>
                        <h4><?php echo e($project->name); ?></h4>
                        <span class="description-text">PROJECT</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4><?php echo e($numberOfParticipantsScreened[$project->id]); ?></h4>
                        <span class="description-text">SCREENED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4><?php echo e($numberOfParticipantsEnrolled[$project->id]); ?></h4>
                        <span class="description-text">ENROLLED</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
    </div>
    
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header border-transparent">
                <h3 class="card-title">Scheduled Visits in the coming 2 Weeks</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
                </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Participant ID</th>
                                <th>Window Opening</th>
                                <th>Window Closing</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $scheduledParticipantVisits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participantVisit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($participantVisit->project->name); ?> </td>
                                <td><?php echo e($participantVisit->participant_id); ?> </td>
                                <td><?php echo e(\Carbon\Carbon::parse($participantVisit->window_start_date)->format('d M, Y')); ?> </td>
                                <td><?php echo e(\Carbon\Carbon::parse($participantVisit->window_end_date)->format('d M, Y')); ?> </td>
                                <td><a href="">Create Appointment</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Appointments this Week</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
                </button>
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                        <div class="product-img">
                        <h4>16th</h4>
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">TZ/008/009
                        <span class="badge badge-warning float-right">Screening</span></a>
                        <span class="product-description">
                        coming for Week 2 visit
                        </span>
                        </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                        <h4>18th</h4>
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">TZ/008/017
                        <span class="badge badge-info float-right">Regular</span></a>
                        <span class="product-description">
                        coming for Month 2 Follow Up Visit
                        </span>
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Appointments</a>
            </div>

        </div>
    </div>

    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/home.blade.php ENDPATH**/ ?>