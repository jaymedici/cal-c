@extends('adminlte::page')
@section('css')

@stop
@section('js')
<script src="{{$pageVariables['vChart']->cdn()}}"></script>
{{ $pageVariables['vChart']->script() }}
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <h4 class="card-title">{{$project->name}} Details</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Screened Participants</span>
                                    <span class="info-box-number text-center text-muted mb-0">{{$pageVariables['screenedNo']}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Enroled Participants</span>
                                    <span class="info-box-number text-center text-muted mb-0">{{$pageVariables['enroledNo']}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Withdrawals</span>
                                    <span class="info-box-number text-center text-muted mb-0">N/A</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-header">
                                <h5 class="card-title">Visit Outcome Chart</h5>
                            </div>
                            <div class="card-body">
                                {!! $pageVariables['vChart']->container() !!}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Quick Stats</h4>
                        </div>
                        
                        <div class="card-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                 <a href="">Completed Visits</a>      <span class="float-right">{{$pageVariables['completedVisits']}}</span>
                                </li>
                                <li class="list-group-item">
                                 <a href="{{ route('participantVisits.projectMissedVisitsIndex', $project->id) }}">Missed Visits</a>     <span class="float-right">{{$pageVariables['missedVisits']}}</span>
                                </li>
                                <li class="list-group-item">
                                 <a href="">Pending Visits</a>    <span class="float-right">{{$pageVariables['pendingVisits']}}</span>
                                </li>
                            </ul>
                            
                            <a class="float-right" href="{{ route('reports.reportsByProject', $project->id) }}">View Project Reports</a>
                        </div>
                    </div>

                    <div class="card card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Quick Links</h4>
                        </div>
                        
                        <div class="card-body">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                <a href="{{ route('participantVisits.projectVisitsIndex', $project->id) }}">Participants Visit Schedule</a>
                                </li>

                                {{-- Temporarily commented out
                                <li class="list-group-item">
                                @livewire('projects.add-user-to-project')
                                </li>
                                <li class="list-group-item">
                                <a href="">Add Site to Project</a>
                                </li>
                                --}}
                            </ul>
                        </div>
                    </div>

                    

                    <div class="card card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Registered Sites</h4>
                        </div>
                        
                        <div class="card-body">
                            <ul class="list-inline">
                                @foreach ($pageVariables['sites'] as $site)
                                <li class="list-inline-item text-center">
                                    <img src="{{ asset('img/site.jpg') }}" alt="Avatar" height="50">
                                    <br> {{$site->site_name}}
                                </li>
                                @endforeach     
                            </ul>
                        </div>
                    </div>

                    <div class="card card-outline">
                        <div class="card-header">
                            <h4 class="card-title">Assigned Users</h4>
                        </div>
                        
                        <div class="card-body">
                            <ul class="list-inline">
                                @livewire('projects.view-assigned-users', 
                                        ['project' => $project])
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>  

@endsection