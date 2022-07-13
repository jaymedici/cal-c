<div class="col-md-12">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <div class="card-title mr-4">
                <h5>All Participant Visits</h5>
            </div>
        </div>
   

        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Site</th>
                        <th>Participant ID</th>
                        <th>Visit</th>
                        <th>Window Dates</th>
                        <th>Appointment Date</th>
                        <th>Visit Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($participantVisits as $participantVisit)
                        <tr wire:loading.remove>
                            <td>{{ $participantVisit->project->name}} </td>
                            <td>{{ $participantVisit->site->site_name}} </td>
                            <td>{{ $participantVisit->participant_id}} </td>
                            <td>{{ $participantVisit->visit->visit_name}}</td>
                            <td>{{ $participantVisit->window_start_date_formatted }} - <br> {{ $participantVisit->window_end_date_formatted }} </td>
                            @if($participantVisit->appointment()->exists())
                            <td>{{ $participantVisit->appointment->appointment_date_time_formatted }}</td>
                            @else
                            <td><i>No set Appt...</i></td>
                            @endif
                            <td>{{ $participantVisit->visit_status}} </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No result found...</td>
                        </tr>
                    @endforelse 
                </tbody>
                
            </table>
            <div wire:loading>
                Processing your query...
            </div>
            <div class="float-right">
                {!! $participantVisits->links() !!}
            </div>
        </div>
    </div>
</div>
