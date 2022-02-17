@extends('adminlte::page')
@section('css')
<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet">
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
<div class="row">
<div class="col-lg-12 col-md-12">
<div class="card card-success">
    <div class="card-header with-border">
                <h3 class="box-title">Upcoming Visits</h3>

                <div class="box-tools pull-right">

                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body" style="">
        <div class="table-responsive">
        <table class="table" id="table">
            <thead >
                            <tr>
                                <th>ParticipantID</th>
                                <th>ProjectName</th>
                                <th>SiteName</th>
                                <th>Visit</th>
                                <th>VisitDate</th>
                                <th>WindowStartDate</th>
                                <th>WindowEndDate</th>
                                <th>Window Days</th>
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
                buttons: ['copy','excel','csv'],
               ajax: '{{ url('upcomingVisitsDatatable') }}',
               columns: [
                        { data: 'patient_id', name: 'patient_id' },
                        { data: 'project.name', name: 'project.name' },
                        { data: 'site_name', name: 'site_name' },
                        { data: 'visit', name: 'visit' },
                        { data: 'visit_date', name: 'visit_date' },
                        { data: 'windows_start_date', name: 'windows_start_date' },
                        { data: 'windows_end_date', name: 'windows_end_date' },
                        { data: 'window_period', name: 'window_period' },
                        { data: 'visit_status', name: 'visit_status' },
                        { data: 'editLink', name: 'editLink' },
                     ]
            });
         });
</script>

@stop