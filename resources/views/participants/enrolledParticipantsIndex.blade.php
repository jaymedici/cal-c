@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    @livewire('participants.view-enrolled-participants', ['project' => $project])
</div>  

@endsection