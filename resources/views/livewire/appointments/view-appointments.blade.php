<div class="col-md-12">
    <div class="card card-outline card-secondary">
        <div class="card-header">
            <div class="card-title mr-4">
                <h5>Participant Appointments</h5>
            </div>
            <div class="card-title mr-4">
                <a wire:click='createAppointment()' class="btn btn-sm btn-success"> <i class="fa fa-plus-circle"></i> Create Appointment</a>
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
                        <th>Visit Type</th>
                        <th>Created By</th>
                        <th>Visit Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
    
                <tbody>
                    @forelse ($appointments as $appointment)
                        <tr wire:loading.remove>
                            <td>
                                {{ $appointment->participant_id }}
                                @if ($appointment->participantVisit)
                                    @if (!$appointment->participantVisit->project->studyArms->isEmpty())
                                    ({{$appointment->participantVisit->participant->studyArm->name}})
                                    @endif
                                @endif
                            </td>
                            <td>{{ $appointment->appointment_date_time }}</td>
                            @if (!empty($appointment->participant_visit_id))
                            <td>{{ $appointment->participantVisit->visit->visit_name}}</td>
                            @else
                                @if(!empty($appointment->screening->screening_label))
                                <td>{{ $appointment->screening->screening_label }}</td>
                                @else
                                <td>{{ $appointment->screening_visit_label }}</td>
                                @endif
                            @endif
                            <td>{{ $appointment->updated_by }}</td>
                            <td>
                                @if ($appointment->participantVisit)
                                    @if ($appointment->participantVisit->visit_status == "Pending")
                                    <span class="text-bold text-info">{{ $appointment->participantVisit->visit_status}}</span> 
                                    @elseif ($appointment->participantVisit->visit_status == "Missed")
                                        <span class="text-bold text-danger">{{ $appointment->participantVisit->visit_status}}</span> 
                                    @elseif ($appointment->participantVisit->visit_status == "Completed")
                                        <span class="text-bold text-success">{{ $appointment->participantVisit->visit_status}}</span> 
                                    @endif
                                @else
                                N/A
                                @endif
                            </td>
                            <td>
                                @if ($appointment->participantVisit)
                                    <a wire:click='editParticipantVisit({{ $appointment->participantVisit }})' class="btn btn-sm btn-warning">Edit Visit</a>
                                @else
                                N/A
                                @endif
                            </td> 
                        </tr>
                    @empty
                    <tr>
                        <td colspan="6">No Result Found... </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
    
            <div wire:loading>
                Processing your query...
            </div>
    
            <div class="d-flex justify-content-end">
            {!! $appointments->links() !!}
            </div>
        </div>
    
        <!-- Appointment Creation Form Modal -->
        @include('modals.createAppointment')

        <!-- Edit Visit Modal -->
        @include('modals.editParticipantVisit')
    </div>
</div>