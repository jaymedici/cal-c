<div class="card card-outline card-secondary col-md-12">
    <div class="card-header">
        <div class="card-title mr-4">
            <h5>Participant Appointments</h5>
        </div>
        <div class="card-title mr-4">
            <a wire:click='createAppointment()' class="btn btn-sm btn-success"> <i class="fa fa-plus-circle"></i> Create Appointment</a>
        </div>

        <!-- <div class="card-title form-group mr-2">
            <select class="form-control-sm" name="">
                <option selected disabled value="">Site Filter</option>
            </select>
        </div>

        <div class="card-title mr-2">
            <button class="btn btn-sm btn-info">
               <i class="fa fa-calendar-alt" aria-hidden="true"></i> Date Filter
            </button>
        </div> -->

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
                    <th>Visit Type</th>
                    <th>Project</th>
                    <th>Site</th>
                    <th>Created By</th>
                </tr>
            </thead>

            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr wire:loading.remove>
                        <td>
                            <?php echo e($appointment->participant_id); ?>

                            <?php if(!$appointment->participantVisit->project->studyArms->isEmpty()): ?>
                            (<?php echo e($appointment->participantVisit->participant->studyArm->name); ?>)
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($appointment->appointment_date_time); ?></td>
                        <?php if(!empty($appointment->participant_visit_id)): ?>
                        <td><?php echo e($appointment->participantVisit->visit->visit_name); ?></td>
                        <?php else: ?>
                            <?php if(!empty($appointment->screening->screening_label)): ?>
                            <td><?php echo e($appointment->screening->screening_label); ?></td>
                            <?php else: ?>
                            <td><?php echo e($appointment->screening_visit_label); ?></td>
                            <?php endif; ?>             
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

    <!-- Appointment Creation Form Modal -->
    <div wire:ignore.self class="modal fade" id="createAppointmentForm" tabindex="-1" role="dialog" aria-labelledby="createAppointmentFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form wire:submit.prevent="saveAppointment">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAppointmentFormLabel">Create Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php if(session()->has('message')): ?>
                    <div class="col-md-12 alert alert-warning alert-dismissible fade show">
                        <?php echo e(session('message')); ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Project</label>
                            <input type="text" class="form-control" value="<?php echo e($projectName); ?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Site</label>
                            <select type="text" wire:model.defer="create_form_state.site_id" class="form-control <?php $__errorArgs = ['site_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="" selected>Choose a Site</option>
                                <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($site->id); ?>"><?php echo e($site->site_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['site_id'];
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
                </div>

                <div class="form-group">
                    <label for="participant_id">Participant ID</label>
                    <select wire:model.defer="create_form_state.participant_id" class="participant-select form-control form-select <?php $__errorArgs = ['participant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="" selected>Select Participant</option>
                        <option value="No ID yet">Participant not assigned ID yet</option>
                        <?php $__currentLoopData = $participantIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
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

                <div x-data="{ visitType: '' }" class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visit_type">Visit Type</label>
                            <select wire:model.defer="create_form_state.visit_type" 
                                    x-model="visitType" 
                                    class="participant-select form-control form-select <?php $__errorArgs = ['visit_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="" selected>Select reason why the participant will be visiting</option>
                                <option value="Test results pickup">Test results pickup</option>
                                <option value="Screening">Screening</option>
                                <option value="Scheduled Visit">Scheduled Visit</option>
                                <option value="Unscheduled Visit">Unscheduled Visit</option>
                            </select>
                            <?php $__errorArgs = ['visit_type'];
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

                    <div class="col-md-6">
                        <div x-show="visitType === 'Screening'" x-transition class="form-group">
                            <label for="screening_visit_label">Screening Visit Type</label>
                            <select wire:model.defer="create_form_state.screening_visit_label" class="participant-select form-control form-select <?php $__errorArgs = ['screening_visit_label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="" selected>Select screening visit</option>
                                <?php $__currentLoopData = $screeningLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['screening_visit_label'];
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

                        <div x-show="visitType === 'Scheduled Visit'" x-transition class="form-group">
                            <label for="visit_id">Visit name</label>
                            <select wire:model.defer="create_form_state.visit_id" class="participant-select form-control form-select <?php $__errorArgs = ['visit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="" selected>Select participant visit</option>
                                <?php $__currentLoopData = $projectVisits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($visit->id); ?>"><?php echo e($visit->visit_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['visit_id'];
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
                </div>        

                <div class="form-group">
                    <label for="name">Appointment Date & Time</label>
                    <input type="datetime-local" wire:model.defer="create_form_state.appointment_date_time" class="form-control <?php $__errorArgs = ['appointment_date_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['appointment_date_time'];
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
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/livewire/appointments/view-appointments.blade.php ENDPATH**/ ?>