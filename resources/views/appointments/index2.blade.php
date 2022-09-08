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
            <h4 class="col-md-12" align="center">Projects Assigned</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Includes Screening</th>
                            <th>Screening Visits</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($assignedProjects as $project)
                        <tr>
                            <td>{{$project->name}}</td>
                            <td>{{$project->include_screening}}</td>
                            <td>{{$project->screening_visit_labels}}</td>
                            <td><a href="{{ route('appointments.viewAppointments',$project->id) }}">View Appointments</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$assignedProjects->links()}}
            </div>
        </div>
    </div>
</div>  

@endsection