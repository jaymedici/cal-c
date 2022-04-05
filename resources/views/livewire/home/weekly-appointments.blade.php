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
                    <a href="{{ route('appointments.viewAppointment', $appointment->id) }}" class="product-title">{{$appointment->participant_id}}
                    @if(isset($appointment->participant_visit_id))
                    <span class="badge badge-info float-right">Regular</span></a>
                    <span class="product-description">
                    Coming for {{$appointment->participantVisit->visit->visit_name}} Visit
                    </span>
                    @elseif(isset($appointment->screening_id))
                    <span class="badge badge-warning float-right">Screening</span></a>
                    <span class="product-description">
                    coming for Screening
                    </span>
                    @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        
        <div class="card-footer text-center">
            <a href="" class="uppercase">View All Appointments</a>
        </div>

    </div>
</div>
