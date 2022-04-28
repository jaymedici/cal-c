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
    <div class="col-md-8">
        <div class="card bg-gradient-dark">
            <img class="card-img-top rounded" src="{{asset('img/walkway.jpg')}}" alt="" height="200" style="object-fit: cover">
            <div class="card-img-overlay d-flex flex-column justify-content-end">
                <h5 class="card-title text-primary text-white">Hello, <strong>{{ strtok(auth()->user()->name, " ") }}!</strong></h5>
                <p class="card-text text-white pb-2 pt-1">Hope you're doing fine today. 
                    <br>You have {{$appointmentsNoToday}} Appointment visits set for today
                </p>
                <a href="/appointments" class="text-white">View appointments</a> 
            </div>               
        </div>

        @livewire('home.scheduled-visits')
    </div>

    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h4 class="card-title">You are currently assigned to these Projects</h4>
            </div>
            
            <div class="card-body">
                <ul class="list-group list-group-unbordered mb-3">
                    @foreach ($userAssignedProjects as $project)
                    <li class="list-group-item">
                       <b> {{$project->name}} </b>  <a href="{{ route('projects.show', $project->id) }}" class="float-right">View Project</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        @livewire('home.weekly-appointments')
    </div>
</div>

@endsection


@section('js')

@stop
