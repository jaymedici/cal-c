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
                @forelse ($screenings as $screening)
                    <tr wire:loading.remove>
                        <td>{{ $screening->participant_id }}</td>
                        <td>{{ $screening->project->name }}</td>
                        <td>{{ $screening->site->site_name }}</td>
                        <td>{{ $screening->screening_date }}</td>
                        <td>{{ $screening->screening_label }}</td>
                        <td>{{ $screening->still_screening }}</td>
                        <td>{{ $screening->next_screening_date }}</td>
                        <td>{{ $screening->screening_outcome }}</td>
                        <td>{{ $screening->updated_by }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No result found...</td>
                    </tr>
                @endforelse 
            </tbody>
        </table>

        <div wire:loading>
            Processing your query...
        </div>

        <div class="float-right">
            {!! $screenings->links() !!}
        </div>
    </div>
</div>
