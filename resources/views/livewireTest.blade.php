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
    <div class="card col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Livewire Tests </h4>
        </div>
   

        <div class="card-body">
            @livewire('hello-world')
        </div>
    </div>
</div>  

@endsection