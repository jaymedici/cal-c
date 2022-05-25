@extends('adminlte::page')
@section('css')

@stop
@section('js')

@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-secondary card-outline col-md-6 offset-md-3">
        <div class="card-header">
            <h4 class="card-title">Profile Settings</h4>
        </div>

        <div class="card-body">
            <form action="{{route('user.updateProfile')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" value="{{$user->name}}" name="name" class="form-control @error('name') is-invalid @enderror" required="true">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>    
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                <button type="submit" class="btn btn-primary">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>  

@endsection