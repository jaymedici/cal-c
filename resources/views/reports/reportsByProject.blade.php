@extends('adminlte::page')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop
@section('js')
<script src="{{$visitOutcomeChart->cdn()}}"></script>
{{ $visitOutcomeChart->script() }}
@stop

@section('content')
@include('partials.errors')
@include('partials.success')
<br>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Visit Outcome Chart</h3>
                    <!-- <a href="">Some link</a> -->
                </div>

            </div>

            <div class="card-body">
                {!! $visitOutcomeChart->container() !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    
</div>
  
@endsection
