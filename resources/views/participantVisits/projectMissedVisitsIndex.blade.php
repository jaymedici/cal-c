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
    <div class="card card-outline card-danger col-md-12">
        <div class="card-header">
            <h4 class="col-md-12" align="center">Missed Visits</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Participant</th>
                            <th>Site</th>
                            <th>Visit</th>
                            <th>Date marked missed</th>
                            <th>Marked by</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($missedVisits as $missedVisit)
                        <tr>
                            <td>{{$missedVisit->participant_id}}</td>
                            <td>{{$missedVisit->site->site_name}}</td>
                            <td>{{$missedVisit->visit->visit_name}}</td>
                            <td>{{$missedVisit->marked_date}}</td>
                            <td>{{$missedVisit->marked_by}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-right">
                {{$missedVisits->links('pagination::bootstrap-4')}}
                </div>
                
            </div>
        </div>
    </div>
</div>  

@endsection