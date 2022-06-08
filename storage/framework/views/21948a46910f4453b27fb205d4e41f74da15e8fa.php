<div class="card card-outline card-primary col-md-12">
    <div class="card-header">
        <div class="card-title mr-4">
            <h5>Participants Screened</h5>
        </div>

        <div class="card-title mr-2">
            <a href="/screening/create" class="btn btn-sm btn-success"> <i class="fa fa-plus-circle"></i> Screen New Participant</a>
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
                    <th>Project</th>
                    <th>Site</th>
                    <th>Date</th>
                    <th>Screening visit</th>
                    <th>Still Screening?</th>
                    <th>Next Screening Date</th>
                    <th>Screening Outcome</th>
                    <th>Screened by</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $screenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr wire:loading.remove>
                        <td><?php echo e($screening->participant_id); ?></td>
                        <td><?php echo e($screening->project->name); ?></td>
                        <td><?php echo e($screening->site->site_name); ?></td>
                        <td><?php echo e($screening->screening_date); ?></td>
                        <td><?php echo e($screening->screening_label); ?></td>
                        <td><?php echo e($screening->still_screening); ?></td>
                        <td><?php echo e($screening->next_screening_date); ?></td>
                        <td><?php echo e($screening->screening_outcome); ?></td>
                        <td><?php echo e($screening->updated_by); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9">No result found...</td>
                    </tr>
                <?php endif; ?> 
            </tbody>
        </table>

        <div wire:loading>
            Processing your query...
        </div>

        <div class="float-right">
            <?php echo $screenings->links(); ?>

        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/screening/view-screenings.blade.php ENDPATH**/ ?>