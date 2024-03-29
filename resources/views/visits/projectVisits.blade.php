@extends('adminlte::page')
@section('css')
<style>
    .dt-buttons {
        text-align: center;
    }

    .buttons-excel {
        color:#fff;
        background-color:#17a2b8;
        border-color:#17a2b8;
    }
    .buttons-csv {
        color:#fff;
        background-color:#28a745;
        border-color:#28a745;
    }

    .buttons-pdf {
        color:#fff;
        background-color:#dc3545;
        border-color:#dc3545;
    }
</style>
@stop
@section('content')
@include('partials.errors')
@include('partials.success')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
   </head>
   <div class="row">
<div class="col-lg-12 col-md-12">
<div class="card card-success">
    <div class="card-header with-border">
                <h3 class="box-title">Visits</h3>

                <div class="box-tools pull-right">

                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body" style="">
            <a class="pull-left btn btn-primary " href="/visits/create">Create New Visit</a>
        <div class="table-responsive">
        <table class="table" id="table">
            <thead class="thead-dark">
                            <tr>
                                <th>VisitName</th>
                                <th>ProjectName</th>
                                <th>number of days</th>
                                <th>Window Period</th>
                                <th>Updated Date</th>
                                <th>Updated By</th>
                                <th>Action</th>
                            </tr>
                      </thead>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/buttons.flash.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/buttons.print.min.js') }}"></script>

<script>
  $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               "scrollX": true,
                dom: 'Blfrtip',
                buttons: ['copy','excel','csv','pdf'],
               ajax: '{{ url('visitsDatatable') }}',
               columns: [
                        { data: 'visit_name', name: 'visit_name' },
                        { data: 'project.name', name: 'project.name' },
                        { data: 'number_of_days', name: 'number_of_days' },
                        { data: 'window_period', name: 'window_period' },
                        { data: 'updated_at', name: 'updated_at'},
                        { data: 'updated_by', name: 'updated_by' },
                        { data: 'editLink', name: 'editLink' }
                     ]
            });
         });
</script>

@stop