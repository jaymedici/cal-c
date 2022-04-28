@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-outline card-secondary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Projects with registered study visits</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Includes Screening</th>
                            <th>Enroled Participants</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($projectsWithVisits as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td>{{$project->include_screening}}</td>
                            <td>{{$project->enrolledParticipants()->count()}}</td>
                            <td><a href="{{ route('participantVisits.createParticipant',$project->id) }}">Enrol Participant</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$projectsWithVisits->links()}}
            </div>
        </div>
    </div>
</div>  

@endsection