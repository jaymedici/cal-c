@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <h4>Sorry! You are not Authorized to View this Page</h4>
</div>  

@endsection