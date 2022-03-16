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
    @livewire('users.view-users')
</div>  

@endsection