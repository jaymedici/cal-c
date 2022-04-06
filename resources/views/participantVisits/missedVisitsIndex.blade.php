@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')
<br>

<div class="row">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Projects assigned</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Enroled Participants</th>
                            <th>No. of missed visits</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td>{{count($project->enrolledParticipants())}}</td>
                            <td>0</td>
                            <td><a href="{{ route('participantVisits.projectMissedVisitsIndex',$project->id) }}">View Missed Visits</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$projects->links()}}
            </div>
        </div>
    </div>
</div>  

@endsection