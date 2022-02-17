@extends('adminlte::page')
@section('css')

@stop
@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card card-info">
            <div class="card-header with-border row">
                <div class="col-md-8">
                    <h4 class="box-title">Sites</h4>
                </div>

                <div class="col-md-4">
                    <a class="float-right btn btn-success " href="/sites/create"><i class="fas fa-plus-circle"></i> Register New Site</a>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="card-body" style="">
                
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Site Name</th>
                                <th>District</th>
                                <th>Region</th>
                                <th>Country</th>
                                <th>Number of Users</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($allSites as $site)
                            <tr>
                                <td>{{$site->site_name}}</td>
                                <td>{{$site->district}}</td>
                                <td>{{$site->region}}</td>
                                <td>{{$site->country}}</td>
                                <td>N/A</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$allSites->links()}}
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
@endsection
