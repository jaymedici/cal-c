<div class="col-md-12">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <div class="card-title mr-4">
                <h5>All Participant Visits</h5>
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
                <select wire:model="visitStatus" class="form-control-sm" name="">
                    <option selected value="">Status Filter</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Missed">Missed</option>
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
                            @else
                            <td><i>No set Appt...</i></td>
                            @endif
                            <td>{{ $participantVisit->visit_status}} </td>
                            {{-- Show Edit visit if date today is greater than closing window date --}}
                            @if($participantVisit->VisitStatusCanBeEdited())
                            <td><a href="#" class="btn btn-sm btn-warning">Edit Visit</a></td> 
                            @endif         
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
