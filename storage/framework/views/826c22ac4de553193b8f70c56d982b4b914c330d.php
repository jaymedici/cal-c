<div class="card card-outline card-primary col-md-12">
    <div class="card-header">
        <div class="card-title mr-4">
            <h5><?php echo e($project->name); ?> Enrolled Participants</h5>
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
                    <th>Site</th>
                    <th>Study Arm</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $enrolledParticipants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrolledParticipant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr wire:loading.remove>
                        <td><?php echo e($enrolledParticipant->participant_id); ?></td>
                        <td><?php echo e($enrolledParticipant->site->site_name); ?></td>
                        <td><?php echo e($enrolledParticipant->studyArm->name); ?></td>
                        <td><a class="btn btn-sm btn-info" href="">Change Study Arm</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <td colspan="6">No Result Found... </td>
                <?php endif; ?>

            </tbody>
        </table>

        <div wire:loading>
            Processing your query...
        </div>

        <div class="d-flex justify-content-end">
        <?php echo $enrolledParticipants->links(); ?>

        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/participants/view-enrolled-participants.blade.php ENDPATH**/ ?>