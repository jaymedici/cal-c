<div class="card card-outline card-secondary col-md-12">
    <div class="card-header">
        <div class="card-title form-group mr-2">
            <select class="form-control-sm" name="">
                <option selected disabled value="">Project Filter</option>
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
                @forelse ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->participant_id }}</td>
                        <td>{{ $appointment->appointment_date_time }}</td>
                        @if (!empty($appointment->participant_visit_id))
                        <td>{{ $appointment->participantVisit->visit->visit_name}}</td>
                        @else
                        <td>{{ $appointment->screening->screening_label }}</td>
                        @endif
                        <td>{{ $appointment->project->name }}</td>
                        <td>{{ $appointment->site->site_name }}</td>
                        <td>{{ $appointment->updated_by }}</td>
                    </tr>
                @empty
                    No Result Found
                @endforelse
            </tbody>
        </table>
    </div>
</div>