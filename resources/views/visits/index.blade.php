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
        <div class="card card-info">
            <div class="card-header">
                <h4 class="box-title">Project Visits</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Visit Creation Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($projects as $project)
                            <tr>
                                <td>{{$project->name}}</td>
                                <td>
                                    @if($project->visits->isEmpty())
                                      <span style="color:red;">No Visits have been created for this Project</span>
                                    @else
                                    <span style="color:green;">Visits have been created for this Project</span>
                                    @endif
                                </td>
                                <td>
                                    @if($project->visits->isEmpty())
                                        <a class="btn btn-success" href="{{ route('visits.createForProject', $project->id) }}">Add/Create Visits</a>
                                    @else
                                        <a class="btn btn-info" href="">View Created Visits</a>
                                    @endif
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