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
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
	 <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<div class="container">
  <div class="row">
@include('charts.homeDataChart')


<div class="col-lg-4 col-md-4">
<div class="card card-success">
    <div class="card-header with-border">
                <h3 class="box-title">Running Project List </h3>
                
                <div class="box-tools pull-right">

                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <!-- /.box-header -->
            
            <div class="card-body" style="">
        <div class="table-responsive">
        <table class="table" id="table">
            <thead class="thead-dark">
                 <tr>
                    <th>ProjectID</th>
                    <th>ProjectName</th>
                    <th>Action</th>
                </tr>
                      </thead>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>


    <div class="col-lg-8 col-md-8">
<div class="card card-success">
    <div class="card-header with-border">
                <h3 class="box-title">Pending and On Window Visit  </h3>
                
                <div class="box-tools pull-right">

                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <!-- /.box-header -->
            
            <div class="card-body" style="">
        <div class="table-responsive">
        <table class="table" id="table1">
            <thead class="thead-dark">
                 <tr>
                               <th>ParticipantID</th>
                                <th>ProjectName</th>
                                <th>Visit</th>
                                <th>VisitDate</th>
                                <th>VisitStatus</th>
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
               ajax: '{{ url('projectListdt') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'editLink', name: 'editLink' }
                     ]
            });
         })

        
         $(function() {
               $('#table1').DataTable({
               processing: true,
               serverSide: true,
               "scrollX": true,
                dom: 'Blfrtip',
                buttons: ['copy','excel','csv','pdf'],
               ajax: '{{ url('PendingOnWindow') }}',
               columns: [
                { data: 'patient_id', name: 'patient_id' },
                        { data: 'project.name', name: 'project.name' },
                        { data: 'visit', name: 'visit' },
                        { data: 'visit_date', name: 'visit_date' },
                        { data: 'visit_status', name: 'visit_status' },
                        { data: 'editLink', name: 'editLink' }
                     ]
            });
         })

</script>


@stop
