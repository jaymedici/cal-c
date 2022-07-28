
<div>
    <div class="card card-outline card-primary col-md-12">
        <div class="card-header">
            <div class="card-title mr-4">
                <h5>Participants Screened</h5>
            </div>
            <div class="card-title mr-2">
                <a href="/screening/screenPatientForm/{{$projectId}}" class="btn btn-sm btn-success"> <i class="fa fa-plus-circle"></i> Screen New Participant</a>
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
                    @foreach ($screeningLabels as $key => $value)
                        <option value="{{$value}}">{{$value}}</option>
                    @endforeach
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
                    @forelse ($screenings as $screening)
                        <tr wire:loading.remove>
                            <td>{{ $screening->participant_id }}</td>
                            <td>{{ $screening->site->site_name }}</td>
                            <td>{{ $screening->screening_date }}</td>
                            <td>{{ $screening->screening_label }}</td>
                            <td>{{ $screening->still_screening }}</td>
                            <td>{{ $screening->next_screening_date }}</td>
                            <td>{{ $screening->screening_outcome }}</td>
                            <td>{{ $screening->updated_by }}</td>
                            <td class="row">
                                <div><a class="btn btn-sm btn-warning" wire:click='editScreening({{ $screening }})'> <i class="fa fa-edit"></i>Edit</a></div>
                                {{-- <div class="col-md-6"><a class="btn btn-sm btn-danger" wire:click='deleteScreening({{ $screening }})'> <i class="fa fa-trash"></i></a></div> --}}
                            </td>
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

    <!-- Edit Screening Modal -->
    @include('modals.editScreening')
</div>

