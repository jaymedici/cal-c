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
        @livewire('home.scheduled-visits')  
    </div>

    <div class="col-md-4">
        @livewire('home.weekly-appointments')
    </div>

    </div>
</div>

@endsection


@section('js')

@stop
