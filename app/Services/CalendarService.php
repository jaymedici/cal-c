<?php

namespace App\Services;

use Acaronlex\LaravelCalendar\Calendar;
use Illuminate\Database\Eloquent\Collection;

class CalendarService
{

    public function eventSetupTest()
    {
        //Always make sure the events variable is an array, otherwise funny things happen
        $events[] = Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            '2015-02-14', //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
            '2015-02-14', //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
            1, //optional event ID
            [
                'url' => 'http://full-calendar.io',
                //any other full-calendar supported parameters
                //'backgroundColor' => 'green',
            ]
        );

        return $events;
    }

    public function getOpeningWindowEvents(Collection $scheduledParticipantVisits)
    {
        foreach($scheduledParticipantVisits as $participantVisit)
        {
            $events[] = Calendar::event(
                $participantVisit->participant_id, 
                true, //full day event?
                $participantVisit->window_start_date, 
                $participantVisit->window_start_date, 
                $participantVisit->id, 
                [
                    //any other full-calendar supported parameters
                ]
            );
        }

        return $events;
    }

    public function getClosingWindowEvents(Collection $scheduledParticipantVisits)
    {
        foreach($scheduledParticipantVisits as $participantVisit)
        {
            $events[] = Calendar::event(
                $participantVisit->participant_id, 
                true, //full day event?
                $participantVisit->window_end_date, 
                $participantVisit->window_end_date, 
                $participantVisit->id, 
                [
                    'backgroundColor' => 'red',
                    'color' => 'red',
                ]
            );
        }

        return $events;
    }

    public function getAppointmentEvents(Collection $appointments)
    {
        foreach($appointments as $appointment)
        {
            $events[] = Calendar::event(
                $appointment->participant_id, 
                false, //full day event?
                $appointment->appointment_date_time, 
                $appointment->appointment_date_time, 
                $appointment->id, 
                [
                    'backgroundColor' => 'green',
                    'color' => 'green',
                    'textColor' => 'green',
                ]
            );
        }

        return $events;
    }

    public function initializeCalendar(array $calendarEvents)
    {
        $calendar = new Calendar();
        $calendar->addEvents($calendarEvents);

        //other views: timeGridDay
        $calendar->setOptions([   
            'firstDay' => 0,
            'displayEventTime' => true,
            'selectable' => true,
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'left' => 'prev,next today myCustomButton',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,listWeek', 
            ],
            'customButtons' => [
                'myCustomButton' => [
                    'text'=> 'custom!',
                    'click' => 'function() {
                        alert(\'clicked the custom button!\');
                    }'
                ]
            ]
        ]);

        $calendar->setId('1');
        $calendar->setCallbacks([
            'select' => 'function(selectionInfo){}',
            'eventClick' => 'function(event){}'
        ]);

        return $calendar;
    }

}