@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')

    @livewire('visits.create-visits-for-project', ['project' => $project])

@endsection
