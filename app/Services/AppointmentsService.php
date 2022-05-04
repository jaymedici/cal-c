<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Screening;
use Carbon\Carbon;

class AppointmentsService
{
    public function createScreeningAppointment(Screening $screening, array $patientData)
    {
        $appointmentDetails['screening_id'] = $screening->id;
        $appointmentDetails['participant_id'] = $patientData['participant_id'];
        $appointmentDetails['project_id'] = $patientData['project_id'];
        $appointmentDetails['site_id'] = $patientData['site_id'];
        $appointmentDetails['appointment_date_time'] = $patientData['next_screening_date'];
        $appointmentDetails['updated_by'] = $patientData['updated_by'];

        Appointment::create($appointmentDetails);
    }

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

    public function allAppointmentsLaterThanToday($userId)
    {
        $dateToday = Carbon::now()->toDateString();

        $appointments = Appointment::whereProjectAssignedTo($userId)
                                    ->whereDate('appointment_date_time', '>=', $dateToday)
                                    ->with('project')->with('site')
                                    ->with('participantVisit')
                                    ->with('screening')
                                    ->orderBy('appointment_date_time', 'asc');

        return $appointments;
    }
 
}