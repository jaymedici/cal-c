<?php

namespace App\Http\Controllers;
use Acaronlex\LaravelCalendar\Calendar;

use Illuminate\Http\Request;
use App\Http\Controllers\ParticipantVisitsController;
use Auth;

class CalendarController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $visitsObject = new ParticipantVisitsController();
        $scheduledParticipantVisits = $visitsObject->getAllScheduledVisits(Auth::id());

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

        foreach($scheduledParticipantVisits as $participantVisit)
        {
            $events[] = Calendar::event(
                $participantVisit->participant_id . ' (' . $participantVisit->visit->visit_name . ')', //event title
                true, //full day event?
                $participantVisit->window_start_date, //start time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg)
                    $participantVisit->window_end_date, //end time, must be a DateTime object or valid DateTime format (http://bit.ly/1z7QWbg),
                $participantVisit->id, //optional event ID
                [
                    //any other full-calendar supported parameters
                ]
            );
        }

        //dd($event);

        $calendar = new Calendar();
        $calendar->addEvents($events);

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

       // dd($calendar);

        return view('calendar.show', compact('calendar'));
    }
}
