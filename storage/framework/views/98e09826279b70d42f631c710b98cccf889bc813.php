
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
            
        </div>
    </div>

    <div class="card col-md-3 ml-2">
        <div class="card-header">
            <h5 class="card-title">Visit Actions</h5>
        </div>

        <div class="card-body">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('appointments.visit-actions', ['appointment' => $appointment])->html();
} elseif ($_instance->childHasBeenRendered('tg96SUA')) {
    $componentId = $_instance->getRenderedChildComponentId('tg96SUA');
    $componentTag = $_instance->getRenderedChildComponentTagName('tg96SUA');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('tg96SUA');
} else {
    $response = \Livewire\Livewire::mount('appointments.visit-actions', ['appointment' => $appointment]);
    $html = $response->html();
    $_instance->logRenderedChild('tg96SUA', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
</div>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cal-c\resources\views/appointments/viewAppointment.blade.php ENDPATH**/ ?>