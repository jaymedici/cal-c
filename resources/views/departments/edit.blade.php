@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')

      @include('partials.errors')
      @include('partials.success')

<div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white;">

<!-- Example row of columns -->
<h3 align="center">Edit Department </h3>

      <div class="row col-sm-12 col-md-12 col-lg-12" style="background:white; margin: 10px">
     
      <form method="post" action="{{route('departments.update',[$departments->id])}}">
                           {{csrf_field()}}
                           <input type="hidden" name="_method" value="put">
                           <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Department Name<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                            
                                <input id="name" 
                                       type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" 
                                       value="{{$departments->name}}" 
                                       
                                       required autocomplete="name" 
                                       autofocus >
                                       
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Department Description<span class="required"><font color="red">*</font></span></label>
                            <div class="col-md-9">
                           
                                <input id="description" 
                                       type="text" 
                                       class="form-control @error('description') is-invalid @enderror" 
                                       name="description" 
                                       value="{{$departments->description}}" 
                                       required autocomplete="description" 
                                       autofocus >
                                      
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <a class="pull-left btn btn-primary" href="{{ url()->previous() }}">Back</a>
                                <button type="submit" class="btn btn-primary">
                                   Save
                                </button>
                                </div>
                                </div>
</form>  


      </div> 

     </div> 
    


        @stop