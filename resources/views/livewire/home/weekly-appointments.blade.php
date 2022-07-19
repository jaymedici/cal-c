<div>
    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">Appointments set for this Week</h3>
            <div class="card-tools">
            </div>
        </div>

        <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach($appointmentsThisWeek as $appointment)
                <li class="item">
                    <div class="product-img">
                    <h4>{{ substr(\Carbon\Carbon::parse($appointment->appointment_date_time)->format('l'), 0, 3) }}</h4>
                    </div>
                    <div class="product-info">
                    @if(isset($appointment->participant_visit_id))
                    <a href="{{ route('appointments.viewAppointment', $appointment->id) }}" class="product-title">{{$appointment->participant_id}}
                    <span class="badge badge-info float-right">Regular</span></a>
                    <span class="product-description">
                    Coming for {{$appointment->participantVisit->visit->visit_name}} Visit
                    </span>
                    @elseif(isset($appointment->screening_id) || $appointment->visit_type == 'Screening')
                    <a href="#" class="product-title">{{$appointment->participant_id}}
                    <span class="badge badge-warning float-right">Screening</span></a>
                    <span class="product-description">
                    coming for 
                    @if(isset($appointment->screening_visit_label))
                        {{$appointment->screening_visit_label}}
                    @endif
                    </span>
                    @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        
        <div class="card-footer">
            <div class="float-right">
                {{ $appointmentsThisWeek->links() }}
            </div>
            <a href="/appointments" class="uppercase">View All Appointments</a>
        </div>

    </div>
</div>
