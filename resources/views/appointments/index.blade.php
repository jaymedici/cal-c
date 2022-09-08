@extends('adminlte::page')

@section('content')

@include('partials.infoMessages')

<div class="row">
    <x-panel>
        <x-panel.header>
            <x-header-title>
                Projects Assigned
            </x-header-title>
        </x-panel.header>

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

    </x-panel>
</div>

@endsection