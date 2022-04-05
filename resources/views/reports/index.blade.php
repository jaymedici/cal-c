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
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h4 class="box-title text-center">Project Reports</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{$project->name}}</td>
                                <td>{{$project->description}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('reports.reportsByProject', $project->id)}}">View Project Reports</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection