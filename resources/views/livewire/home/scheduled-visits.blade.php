<div>
    <div class="card card-outline card-success">
        <div class="card-header border-transparent">
            <h3 class="card-title">Scheduled Visits for the coming two Weeks</h3>
            <div class="card-tools">
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

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Participant ID</th>
                            <th>Visit</th>
                            <th>Window</th>
                            <th>Set Appt</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scheduledParticipantVisits as $participantVisit)
                        <tr>
                            <td>{{ $participantVisit->project->name}} </td>
                            <td>
                                {{ $participantVisit->participant_id}} 
                                @if (!$participantVisit->project->studyArms->isEmpty())
                                    ({{$participantVisit->participant->studyArm->name}})
                                @endif
                            </td>
                            <td>{{ $participantVisit->visit->visit_name}}</td>
                            <td>{{ $participantVisit->window_start_date_formatted }} - <br> {{ $participantVisit->window_end_date_formatted }} </td>
                            @if($participantVisit->appointment()->exists())
                            <td>{{ $participantVisit->appointment->appointment_date_time_formatted }}</td>
                            <td><a class="btn btn-sm btn-warning" href="#" wire:click.prevent="changeAppointment({{$participantVisit}})"> <i class="fa fa-pen-square"></i> Change Appt.</a></td>
                            @else
                            <td><i>No set Appt...</i></td>
                            <td><a class="btn btn-sm btn-primary" href="" wire:click.prevent="setAppointment({{$participantVisit}})"> <i class="fa fa-plus-circle"></i> Set Appt.</a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="float-right">
                <a href="{{ route('participantVisits.viewVisits') }}">View All Visits</a>
            </div>
            {{ $scheduledParticipantVisits->links() }}
        </div>

    </div>

    <!-- Set Appointment Modal -->
    @include('modals.setAppointment')

    <!-- Change Appointment Modal -->
    @include('modals.changeAppointment')

</div>
