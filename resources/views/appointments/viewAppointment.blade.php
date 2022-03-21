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
    <div class="card col-md-8 mr-2">
        <div class="card-header">
            <h5 class="card-title">Appointment Details </h5>
        </div>
   
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="font-weight: bold;">Project</td>
                        <td>{{ $appointment->project->name }}</td>
                    </tr>
                    @if($appointment->participantVisit()->exists())
                    <tr>
                        <td style="font-weight: bold;">Participant ID</td>
                        <td>{{ $appointment->participantVisit->participant_id }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Visit</td>
                        <td>{{ $appointment->participantVisit->visit->visit_name }}</td>                      
                    </tr>
                    @endif
                    <tr>
                        <td style="font-weight: bold;">Current Set Appointment</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('g:i a l jS F Y') }}</td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>

    <div class="card col-md-3 ml-2">
        <div class="card-header">
            <h5 class="card-title">Visit Actions</h5>
        </div>

        <div class="card-body">
            @livewire('appointments.visit-actions', ['appointment' => $appointment])
        </div>
    </div>
</div>  

@endsection