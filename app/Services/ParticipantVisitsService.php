<?php

namespace App\Services;

use App\Models\ParticipantVisit;
use Carbon\Carbon;

class ParticipantVisitsService
{
    public static function get2WeeksScheduledVisits($userId)
    {
        $now = Carbon::now();
        $datetoday = Carbon::createFromFormat('Y-m-d H:s:i', $now);
        $timeInterval = \Carbon\CarbonInterval::weeks(2);
        $dateAfterTwoWeeks = $now->add($timeInterval)->toDateTimeString();

        $participantVisits = ParticipantVisit::with('project')->with('appointment')
                                ->whereProjectAssignedTo($userId)
                                ->whereBetween('window_end_date', [$datetoday, $dateAfterTwoWeeks])
                                ->orderBy('window_start_date', 'asc')
                                ->paginate(5);

        return $participantVisits;
    }

    public static function getAllScheduledVisits($userId)
    {
        $participantVisits = ParticipantVisit::with('project')->whereProjectAssignedTo($userId)->get();

        return $participantVisits;
    }
}