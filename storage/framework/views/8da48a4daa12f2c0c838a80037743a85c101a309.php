
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e($pageVariables['vChart']->cdn()); ?>"></script>
<?php echo e($pageVariables['vChart']->script()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <h4 class="card-title"><?php echo e($project->name); ?> Details</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Screened Participants</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?php echo e($pageVariables['screenedNo']); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Enroled Participants</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?php echo e($pageVariables['enroledNo']); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Withdrawals</span>
                                    <span class="info-box-number text-center text-muted mb-0">N/A</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-header">
                                <h5 class="card-title">Visit Outcome Chart</h5>
                            </div>
                            <div class="card-body">
                                <?php echo $pageVariables['vChart']->container(); ?>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Quick Stats</h4>
                        </div>
                        
                        <div class="card-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                 <a href="">Completed Visits</a>      <span class="float-right"><?php echo e($pageVariables['completedVisits']); ?></span>
                                </li>
                                <li class="list-group-item">
                                 <a href="<?php echo e(route('participantVisits.projectMissedVisitsIndex', $project->id)); ?>">Missed Visits</a>     <span class="float-right"><?php echo e($pageVariables['missedVisits']); ?></span>
                                </li>
                                <li class="list-group-item">
                                 <a href="">Pending Visits</a>    <span class="float-right"><?php echo e($pageVariables['pendingVisits']); ?></span>
                                </li>
                            </ul>
                            
                            <a class="float-right" href="<?php echo e(route('reports.reportsByProject', $project->id)); ?>">View Project Reports</a>
                        </div>
                    </div>

                    <div class="card card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Quick Links</h4>
                        </div>
                        
                        <div class="card-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                <a href="<?php echo e(route('participantVisits.projectVisitsIndex', $project->id)); ?>">Participants Visit Schedule</a>
                                </li>
                                <li class="list-group-item">
                                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('projects.add-user-to-project')->html();
} elseif ($_instance->childHasBeenRendered('k9A1Z7T')) {
    $componentId = $_instance->getRenderedChildComponentId('k9A1Z7T');
    $componentTag = $_instance->getRenderedChildComponentTagName('k9A1Z7T');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('k9A1Z7T');
} else {
    $response = \Livewire\Livewire::mount('projects.add-user-to-project');
    $html = $response->html();
    $_instance->logRenderedChild('k9A1Z7T', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                </li>
                                <li class="list-group-item">
                                <a href="">Add Site to Project</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    

                    <div class="card card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Registered Sites</h4>
                        </div>
                        
                        <div class="card-body">
                            <ul class="list-inline">
                                <?php $__currentLoopData = $pageVariables['sites']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-inline-item text-center">
                                    <img src="<?php echo e(asset('img/site.jpg')); ?>" alt="Avatar" height="50">
                                    <br> <?php echo e($site->site_name); ?>

                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                            </ul>
                        </div>
                    </div>

                    <div class="card card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Assigned Users</h4>
                        </div>
                        
                        <div class="card-body">
                            <ul class="list-inline">
                                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('projects.view-assigned-users', 
                                        ['project' => $project])->html();
} elseif ($_instance->childHasBeenRendered('dMczSHg')) {
    $componentId = $_instance->getRenderedChildComponentId('dMczSHg');
    $componentTag = $_instance->getRenderedChildComponentTagName('dMczSHg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('dMczSHg');
} else {
    $response = \Livewire\Livewire::mount('projects.view-assigned-users', 
                                        ['project' => $project]);
    $html = $response->html();
    $_instance->logRenderedChild('dMczSHg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/projects/show.blade.php ENDPATH**/ ?>