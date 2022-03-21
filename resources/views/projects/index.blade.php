@extends('adminlte::page')
@section('css')

@stop
@section('content')
@include('partials.errors')
@include('partials.success')
<br>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card card-info">
            <div class="card-header with-border row">
                <div class="col-md-8">
                    <h4 class="box-title">Projects</h4>
                </div>

                <div class="col-md-4">
                    <a class="float-right btn btn-success " href="/projects/create"><i class="fas fa-plus-circle"></i> Register New Project</a>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="card-body" style="">
                
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Project Description</th>
                                <th>Includes Screening</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($allProjects as $project)
                            <tr>
                                <td>{{$project->name}}</td>
                                <td>{{$project->description}}</td>
                                <td>{{$project->include_screening}}</td>
                                <td><a href="#">View Project</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$allProjects->links()}}
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
@endsection
