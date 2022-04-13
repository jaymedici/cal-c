<?php

namespace App\Services;

use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentsService
{
    public function getAppointmentsThisWeek($userId)
    {
        $datetoday = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
        $weekendDate = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now()->endOfWeek());

        $appointments = Appointment::whereProjectAssignedTo($userId)
                ->whereBetween('appointment_date_time', [$datetoday, $weekendDate])
                ->orderBy('appointment_date_time', 'asc')
                ->get();

        return $appointments;
    }

    public function appointmentsToday($userId)
    {
        $datetoday = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());

        $appointments = Appointment::whereProjectAssignedTo($userId)
                ->whereDate('appointment_date_time', '=', $datetoday)
                ->orderBy('appointment_date_time', 'asc');

        return $appointments;
    }

    public function getAppointmentsToday($userId)
    {
        return $this->appointmentsToday($userId)->get();
    }

    public function countAppointmentsToday($userId)
    {
        return $this->appointmentsToday($userId)->count();
    }

    public static function getAllAppointments($userId)
    {
        $appointments = Appointment::whereProjectAssignedTo($userId)
                ->orderBy('appointment_date_time', 'asc')
                ->get();

        return $appointments;
    }
 
}