@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

    @livewire('visits.create-visits-for-project', ['project' => $project])

@endsection