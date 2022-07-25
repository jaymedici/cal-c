
<div>
    <div class="card card-outline card-primary col-md-12">
        <div class="card-header">
            <div class="card-title mr-4">
                <h5>Participants Screened</h5>
            </div>
            <div class="card-title mr-2">
                <a href="/screening/screenPatientForm/<?php echo e($projectId); ?>" class="btn btn-sm btn-success"> <i class="fa fa-plus-circle"></i> Screen New Participant</a>
            </div>
            <div class="card-title mr-2">
                <div class="input-group input-group-sm">
                    <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search Participant...">
                    <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </div>
            <div class="card-title form-group mr-2">
                <select wire:model="screeningLabel" class="form-control-sm" name="">
                    <option selected value="">Visit Filter</option>
                    <?php $__currentLoopData = $screeningLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="card-title form-group mr-2">
                <select wire:model="screeningOutcome" class="form-control-sm" name="">
                    <option selected value="">Outcome Filter</option>
                    <option value="Continue Screening">Continue Screening</option>
                    <option value="Enrol">Enrol</option>
                    <option value="Screen Failure">Screen Failure</option>
                </select>
            </div>
            <div class="card-title mr-2">
                <a wire:click="clearFilters" href="#" class="btn btn-sm btn-secondary"> <i class="fa fa-eraser"></i> Clear Filters</a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Participant ID</th>
                        <th>Site</th>
                        <th>Date</th>
                        <th>Screening visit</th>
                        <th>Still Screening?</th>
                        <th>Next Screening Date</th>
                        <th>Screening Outcome</th>
                        <th>Screened by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $screenings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr wire:loading.remove>
                            <td><?php echo e($screening->participant_id); ?></td>
                            <td><?php echo e($screening->site->site_name); ?></td>
                            <td><?php echo e($screening->screening_date); ?></td>
                            <td><?php echo e($screening->screening_label); ?></td>
                            <td><?php echo e($screening->still_screening); ?></td>
                            <td><?php echo e($screening->next_screening_date); ?></td>
                            <td><?php echo e($screening->screening_outcome); ?></td>
                            <td><?php echo e($screening->updated_by); ?></td>
                            <td class="row">
                                <div><a class="btn btn-sm btn-warning" wire:click='editScreening(<?php echo e($screening); ?>)'> <i class="fa fa-edit"></i>Edit</a></div>
                                
                            </td>
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

    <!-- Edit Screening Modal -->
    <div wire:ignore.self class="modal fade" id="editScreeningForm" tabindex="-1" role="dialog" aria-labelledby="editScreeningFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="updateScreening">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScreeningFormLabel">Edit Screening Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="participant_id">Participant ID</label>
                    <input type="text" wire:model.defer="edit_form_state.participant_id" class="form-control <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  placeholder="Enter Participant Id">
                    <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                        <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label for="screening_date">Screening Date</label>
                    <input type="date" wire:model.defer="edit_form_state.screening_date" class="form-control <?php $__errorArgs = ['screening_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  placeholder="Enter Screening Date">
                    <?php $__errorArgs = ['screening_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                    <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="screening_label">Screening Visit</label>
                    <select wire:model.defer="edit_form_state.screening_label" class="form-control form-select <?php $__errorArgs = ['screening_label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option selected disabled> </option>
                        <?php $__currentLoopData = $screeningLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['screening_label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                    <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="form-group">
                    <label for="still_screening">Still Screening?</label>
                    <select wire:model.defer="edit_form_state.still_screening" class="form-control form-select <?php $__errorArgs = ['still_screening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option selected disabled> </option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <?php $__errorArgs = ['still_screening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                    <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="screening_outcome">Screening Outcome</label>
                    <select wire:model.defer="edit_form_state.screening_outcome" class="form-control form-select <?php $__errorArgs = ['screening_outcome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option selected disabled> </option>
                        <option value="Continue Screening">Continue Screening</option>
                        <option value="Enrol">Enrol</option>
                        <option value="Screen Failure">Screen Failure</option>
                    </select>
                    <?php $__errorArgs = ['screening_outcome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">
                    <?php echo e($message); ?>

                    </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </div>
            </form>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/screening/view-screenings.blade.php ENDPATH**/ ?>