@extends('adminlte::page')
@section('css')

@stop
@section('content_header')
  <!--  <h1 class="m-0 text-dark">Dashboard</h1>-->
@stop
@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div id="carouselExampleControls" class="carousel slide col-12" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-interval="8000">
        <div class="row" style="background-color:white;">
                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;</span>
                        <h4>{{$projectsAssignedCount}}</h4>
                        <span class="description-text">PROJECTS ASSIGNED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4>20</h4>
                        <span class="description-text">SCREENED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4>15</h4>
                        <span class="description-text">ENROLLED</span>
                    </div>
                </div>
            </div>
        </div>
        @foreach($projectsAssigned as $project)
        <div class="carousel-item" data-interval="8000">
            <div class="row" style="background-color:white;">
                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fa fa-folder" aria-hidden="true"></i>&nbsp;</span>
                        <h4>{{$project->name}}</h4>
                        <span class="description-text">PROJECT</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4>{{$numberOfParticipantsScreened[$project->id]}}</h4>
                        <span class="description-text">SCREENED</span>
                    </div>
                </div>

                <div class="col-sm-4 col-6">
                    <div class="description-block">
                        <span class="description-percentage text-success"><i class="fas fa-users" aria-hidden="true"></i>&nbsp;</span>
                        <h4>{{$numberOfParticipantsEnrolled[$project->id]}}</h4>
                        <span class="description-text">ENROLLED</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach    
    </div>
    
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-8">
        <div class="card card-success">
            <div class="card-header border-transparent">
                <h3 class="card-title">Scheduled Visits in the coming 2 Weeks</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
                </button> -->
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Participant ID</th>
                                <th>Window Period</th>
                                <th>Appt Set</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scheduledParticipantVisits as $participantVisit)
                            <tr>
                                <td>{{ $participantVisit->project->name}} </td>
                                <td>{{ $participantVisit->participant_id}} </td>
                                <td>{{ \Carbon\Carbon::parse($participantVisit->window_start_date)->format('d M, Y') }} - 
                                {{ \Carbon\Carbon::parse($participantVisit->window_end_date)->format('d M, Y') }} </td>
                                <td>
                                @if($participantVisit->appointment()->exists())
                                <span class="badge badge-success">Yes</span></a>
                                @else
                                <span class="badge badge-warning">No</span></a>
                                @endif
                                </td>
                                <td><a href="{{ route('appointments.createFromVisit', $participantVisit->id) }}">Set Appointment</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-center">
                {{ $scheduledParticipantVisits->links() }}
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Appointments this Week</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
                </button> -->
                </div>
            </div>

            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                        <div class="product-img">
                        <h4>MON</h4>
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">TZ/008/009
                        <span class="badge badge-warning float-right">Screening</span></a>
                        <span class="product-description">
                        coming for Week 2 visit
                        </span>
                        </div>
                    </li>

                    @foreach($appointmentsThisWeek as $appointment)
                    <li class="item">
                        <div class="product-img">
                        <h4>WED</h4>
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{$appointment->participant_id}}
                        @if(isset($appointment->participant_visit_id))
                        <span class="badge badge-info float-right">Regular</span></a>
                        <span class="product-description">
                        Coming for {{$appointment->participantVisit->visit->visit_name}} Visit
                        </span>
                        @elseif(isset($appointment->screening_id))
                        <span class="badge badge-warning float-right">Screening</span></a>
                        <span class="product-description">
                        coming for Screening
                        </span>
                        @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Appointments</a>
            </div>

        </div>
    </div>

    </div>
</div>

@endsection


@section('js')

@stop
