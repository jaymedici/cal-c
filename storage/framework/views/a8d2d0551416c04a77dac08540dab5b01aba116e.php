<div class="card card-outline card-secondary col-md-12">
    <div class="card-header">
        <div class="card-title form-group mr-2">
            <select wire:model="project" class="form-control-sm" name="">
                <option selected disabled value="">Project Filter</option>
                <option value=null>Show All</option>
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="card-title form-group mr-2">
            <select class="form-control-sm" name="">
                <option selected disabled value="">Site Filter</option>
            </select>
        </div>

        <div class="card-title">
            <button class="btn btn-sm btn-info">
               <i class="fa fa-calendar-alt" aria-hidden="true"></i> Date Filter
            </button>
        </div>

        <div class="card-tools">
            <div class="input-group input-group-sm">
                <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search Participant...">
                <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Participant ID</th>
                    <th>Date & Time</th>
                    <th>Visit</th>
                    <th>Project</th>
                    <th>Site</th>
                    <th>Created By</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr wire:loading.remove>
                        <td><?php echo e($appointment->participant_id); ?></td>
                        <td><?php echo e($appointment->appointment_date_time); ?></td>
                        <?php if(!empty($appointment->participant_visit_id)): ?>
                        <td><?php echo e($appointment->participantVisit->visit->visit_name); ?></td>
                        <?php else: ?>
                        <td><?php echo e($appointment->screening->screening_label); ?></td>
                        <?php endif; ?>
                        <td><?php echo e($appointment->project->name); ?></td>
                        <td><?php echo e($appointment->site->site_name); ?></td>
                        <td><?php echo e($appointment->updated_by); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6">No Result Found... </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div wire:loading>
            Processing your query...
        </div>

        <div class="d-flex justify-content-end">
        <?php echo $appointments->links(); ?>

        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/appointments/view-appointments.blade.php ENDPATH**/ ?>