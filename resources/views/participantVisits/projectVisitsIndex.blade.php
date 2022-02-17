@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-primary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Participant Visit Schedule for {{$project->name}}</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive table-bordered table-striped table-hover ">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="table-active">Participant ID</th>
                            @foreach($project->visits as $visit)
                                @if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up")
                                <th class="table-active" colspan="5">{{$visit->visit_name}}</th>
                                @else
                                <th class="table-active">{{$visit->visit_name}}</th>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <th class="table-secondary"></th>
                            @foreach($project->visits as $visit)
                                @if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up")
                                <th class="table-secondary">Window Min</th>
                                <th class="table-secondary">Calculated</th>
                                <th class="table-secondary">Actual</th>
                                <th class="table-secondary">Window Max</th>
                                <th class="table-secondary">Status</th>
                                @else
                                <th class="table-secondary">Date</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($participants as $participant)
                        <tr>
                            <td class="table-primary"><strong>{{$participant}}</strong></td>
                            <!-- @foreach($visitSchedule[$participant] as $schedule)
                            
                            @endforeach -->
                            @foreach($project->visits as $visit)
                                @if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up")
                                <td> {{ \Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->window_start_date)->format('d M, Y') }} </td>
                                <td> {{ \Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->visit_date)->format('d M, Y')}} </td>
                                <td> {{ $visitSchedule[$participant][$visit->id]->actual_visit_date}} </td>
                                <td> {{ \Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->window_end_date)->format('d M, Y')}} </td>
                                    @if( $visitSchedule[$participant][$visit->id]->visit_status == "Pending")
                                    <td class="bg-info"> {{ $visitSchedule[$participant][$visit->id]->visit_status}} </td>
                                    @elseif( $visitSchedule[$participant][$visit->id]->visit_status == "Completed")
                                    <td class="bg-success"> {{ $visitSchedule[$participant][$visit->id]->visit_status}} </td>
                                    @elseif( $visitSchedule[$participant][$visit->id]->visit_status == "Missed Visit")
                                    <td class="bg-danger"> {{ $visitSchedule[$participant][$visit->id]->visit_status}} </td>
                                    @endif
                                @else
                                <td class="table-success"> {{ \Carbon\Carbon::parse($visitSchedule[$participant][$visit->id]->visit_date)->format('d M, Y')}} </td>
                                @endif
                            @endforeach
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>  

@endsection