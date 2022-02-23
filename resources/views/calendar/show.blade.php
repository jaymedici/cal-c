@extends('adminlte::page')
@section('css')
<link href="{{ asset('fullcalendar/main.css') }}" rel='stylesheet' />
@stop
@section('js')


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.min.js"></script>
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-secondary col-md-12">
    <div class="card-header">
            <h4 class="col-md-12" align="center">Visit Schedule & Appointments Calendar </h4>
        </div> 
   
        <div class="card-body">
            {!! $calendar->calendar() !!}
            {!! $calendar->script() !!}
        </div>
    </div>
</div>  

@endsection

@section('js')
    
@stop