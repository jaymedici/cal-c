@extends('adminlte::page')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-secondary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Register New Site</h4>
        </div>

        <div class="card-body">
            <form action="{{route('sites.store')}}" method="post">
                    {!! csrf_field() !!}

                <div class="form-group row">
                    <label for="site_name" class="col-md-3 col-form-label text-md-left">Site Name<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <input id="site_name" type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                name="site_name" value="{{ old('site_name') }}" required autocomplete="site_name" autofocus >
                        @error('site_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="district" class="col-md-3 col-form-label text-md-left">District</label>
                    <div class="col-md-9">
                        <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" 
                                name="district" value="{{ old('district') }}" autocomplete="district" autofocus >
                        @error('district')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="region" class="col-md-3 col-form-label text-md-left">Region</label>
                    <div class="col-md-9">
                        <input id="region" type="text" class="form-control @error('region') is-invalid @enderror" 
                                name="region" value="{{ old('region') }}" autocomplete="region" autofocus >
                        @error('region')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror  
                    </div>
                </div>

                <div class="form-group row">
                    <label for="country" class="col-md-3 col-form-label text-md-left">Country</label>
                    <div class="col-md-9">
                        <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" 
                                name="country" value="{{ old('country') }}" autocomplete="country" autofocus >
                        @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror  
                    </div>
                </div>

                <div class="form-group row">
                    <label for="site_users" class="col-md-3 col-form-label text-md-left">Assign Users to Site<span class="required"><font color="red">*</font></span></label>
                    <div class="col-md-9">
                        <select name="site_users[]" class="selectpicker form-control @error('site_users') is-invalid @enderror" id="site_users" multiple>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('site_users')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-6">
                    <a class="pull-left btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        <button type="submit" class="btn btn-success">
                            Save Site
                        </button>
                        </div>
                </div>

            </form>
        </div>
    </div>
</div>  

@endsection