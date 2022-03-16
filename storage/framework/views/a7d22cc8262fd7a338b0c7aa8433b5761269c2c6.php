
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<br>

<div class="row">
    <div class="card col-md-8 mr-2">
        <div class="card-header">
            <h5 class="card-title">Appointment Details </h5>
        </div>
   
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="font-weight: bold;">Project</td>
                        <td><?php echo e($appointment->project->name); ?></td>
                    </tr>
                    <?php if($appointment->participantVisit()->exists()): ?>
                    <tr>
                        <td style="font-weight: bold;">Participant ID</td>
                        <td><?php echo e($appointment->participantVisit->participant_id); ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Visit</td>
                        <td><?php echo e($appointment->participantVisit->visit->visit_name); ?></td>                      
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td style="font-weight: bold;">Current Set Appointment</td>
                        <td><?php echo e(\Carbon\Carbon::parse($appointment->appointment_date_time)->format('g:i a l jS F Y')); ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <a href="#" class="btn btn-info">Change Appointment Date</a>
        </div>
    </div>

    <div class="card col-md-3 ml-2">
        <div class="card-header">
            <h5 class="card-title">Visit Actions</h5>
        </div>

        <div class="card-body">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('appointments.visit-actions')->html();
} elseif ($_instance->childHasBeenRendered('e3ugP6P')) {
    $componentId = $_instance->getRenderedChildComponentId('e3ugP6P');
    $componentTag = $_instance->getRenderedChildComponentTagName('e3ugP6P');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('e3ugP6P');
} else {
    $response = \Livewire\Livewire::mount('appointments.visit-actions');
    $html = $response->html();
    $_instance->logRenderedChild('e3ugP6P', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/appointments/viewAppointment.blade.php ENDPATH**/ ?>