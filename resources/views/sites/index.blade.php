@extends('adminlte::page')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.users-multiple').select2();
    });
</script>
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
                                <th>Site Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($allSites as $site)
                            <tr>
                                <td>{{$site->site_name}}</td>
                                <td>{{$site->district}}</td>
                                <td>{{$site->region}}</td>
                                <td>{{$site->country}}</td>
                                <td>{{$site->users_count}}</td>
                                <td><a class="btn btn-info btn-sm" data-toggle="modal" data-target="#AddUsersModal{{$site->id}}">Add Users</a>
                                <a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ViewUsersModal{{$site->id}}">View Users</a></td>
                                <!-- Add Users to Site Modal -->
                                 @include('partials.addUsersToSite')
                                 <!-- Site Users Modal -->
                                 @include('partials.viewSiteUsers')
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
