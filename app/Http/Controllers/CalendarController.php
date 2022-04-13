<?php

namespace App\Http\Controllers;

use App\Services\AppointmentsService;
use App\Services\CalendarService;
use App\Services\ParticipantVisitsService;

class CalendarController extends Controller
{
    protected $service;

    public function __construct(CalendarService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function show()
    {
        $scheduledParticipantVisits = ParticipantVisitsService::getAllScheduledVisits(auth()->id());
        $appointments = AppointmentsService::getAllAppointments(auth()->id());

        $openingWindowEvents = $this->service->getOpeningWindowEvents($scheduledParticipantVisits);
        $closingWindowEvents = $this->service->getClosingWindowEvents($scheduledParticipantVisits);
        $appointmentEvents = $this->service->getAppointmentEvents($appointments);

        $calendarEvents = array_merge($openingWindowEvents, $closingWindowEvents, $appointmentEvents); 
        $calendar = $this->service->initializeCalendar($calendarEvents);

        return view('calendar.show', compact('calendar'));
    }
}
