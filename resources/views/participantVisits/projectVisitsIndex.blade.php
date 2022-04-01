@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

    @livewire('participant-visits.view-all-participant-visits', ['projectId' => $projectId])

@endsection