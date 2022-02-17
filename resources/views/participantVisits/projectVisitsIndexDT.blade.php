@extends('adminlte::page')
@section('css')
<link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet">
@stop
@section('js')
<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/buttons.flash.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/buttons.print.min.js') }}"></script>

<script>
    $(window).on('load', function() {
        const columns = {!! json_encode($columns) !!};
        let str = '';
        var i = 1;
        var columnObject = {data: "window_end_date_25", name: "window_end_date_25"};
        var cArray = [];
        var obj = {name: "participant_id", data: "participant_id"};

        for (const value of columns)
        {
           //console.log(value);
           //console.log('{ data: ' + value.data + ',  name: ' + value.name + '},');
           str += "{ data: '" + value.data + "', name: '" + value.name + "'}, ";
           columnObject = Object.assign({value}, columnObject);
        }

        for (let i=1; i <= columns.length; i++)
        {
            //console.log(columns[i].name);
            //cArray.push(columns[i]);
            obj = Object.assign(obj, columns[i]);
        }

        //data = JSON.parse(columns);
    
        console.log(columns);
        
    });

    $(function() {
        var url = '{{ url('participantVisits/projectVisitsIndexDT') }}';   
        var project = {!! json_encode($project) !!};
        var projectId = project.id;
        var cArray = [];
        // Get Columns
        const columns = {!! json_encode($columns) !!};
        let strColumns = '';
        for (const value of columns)
        {
           //console.log(value);
           //console.log('{ data: ' + value.data + ',  name: ' + value.name + '},');
           strColumns += "{ data: '" + value.data + "', name: '" + value.name + "'}, ";
        }


        $('#table').DataTable({
            processing: true,
            serverSide: true,
            "scrollX": true,
            dom: 'Blfrtip',
            buttons: ['copy','excel','csv','pdf'],
            ajax: url + '/' + projectId,
            columns: columns
        });

        

        
    });
</script>
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <div class="card card-primary col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Participant Visit Schedule for {{$project->name}}</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive table-bordered">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Participant ID</th>
                            @foreach($project->visits as $visit)
                                @if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up")
                                <th colspan="4">{{$visit->visit_name}}</th>
                                @else
                                <th>{{$visit->visit_name}}</th>
                                @endif
                            @endforeach
                        </tr>

                        <tr>
                            <th></th>
                            @foreach($project->visits as $visit)
                                @if($visit->visit_type == "Regular" || $visit->visit_type == "Follow Up")
                                <th>Window Min</th>
                                <th>Calculated</th>
                                <th>Actual</th>
                                <th>Window Max</th>
                                @else
                                <th>Date</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                </table>
                
            </div>
        </div>
    </div>
</div>  

@endsection

@section('js')

@stop