@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    @livewire('screening.view-screenings', ['projectId' => $projectId])
</div>  

@endsection