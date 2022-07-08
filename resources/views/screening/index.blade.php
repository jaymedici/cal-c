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
            <h4 class="col-md-12" align="center">Projects with Screening Visits</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Screening Visits</th>
                            <th>Screened Participants</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($projectsWithScreening as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td>{{$project->screening_visit_labels}}</td>
                            <td>{{$project->screenedParticipants()->count()}}</td>
                            <td><a href="{{ route('screening.viewScreenings',$project->id) }}">Show Screening</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$projectsWithScreening->links()}}
            </div>
        </div>
    </div>
</div>  

@endsection