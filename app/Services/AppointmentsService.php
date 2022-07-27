<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\ParticipantVisit;
use App\Models\Screening;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

    public static function getAppointmentVisitType(Appointment $appointment)
    {
        $visitType = '';
        
        if(!empty($appointment->participant_visit_id))
        {
            $visitType = $appointment->participantVisit->visit->visit_name;
        } 
        elseif(!empty($appointment->screening_id))
        {
            $visitType = $appointment->screening->screening_label;
        }

        return $visitType;
    }

    public function getAppointmentsThisWeek($userId)
    {
        $datetoday = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
        $weekendDate = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now()->endOfWeek());

        $appointments = Appointment::with('participantVisit')
                ->whereProjectAssignedTo($userId)
                ->whereSiteAssignedTo($userId)
                ->whereBetween('appointment_date_time', [$datetoday, $weekendDate])
                ->orderBy('appointment_date_time', 'asc')
                ->simplePaginate(5);

        return $appointments;
    }

    public function appointmentsToday($userId)
    {
        $datetoday = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());

        $appointments = Appointment::whereProjectAssignedTo($userId)
                ->whereSiteAssignedTo($userId)
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
                ->whereSiteAssignedTo($userId)
                ->orderBy('appointment_date_time', 'asc')
                ->get();

        return $appointments;
    }

    public function allAppointmentsLaterThanToday($userId)
    {
        $dateToday = Carbon::now()->toDateString();

        $appointments = Appointment::whereProjectAssignedTo($userId)
                                    ->whereSiteAssignedTo($userId)
                                    ->whereDate('appointment_date_time', '>=', $dateToday)
                                    ->with('project')->with('site')
                                    ->with('participantVisit')
                                    ->with('screening')
                                    ->orderBy('appointment_date_time', 'asc');

        return $appointments;
    }

    public function loadCreateAppointmentValidationRules(array $formDetails)
    {
        return Validator::make($formDetails, [
                'site_id' => 'required',
                'participant_id' => 'required',
                'visit_type' => 'required',
                'appointment_date_time' => 'required',
                'screening_visit_label' => 'required_if:visit_type,Screening',
                'visit_id' => 'required_if:visit_type,Scheduled Visit'
                ]);
    }

    public function getCorrespondingParticipantVisitId(array $formDetails)
    {
        if($formDetails['visit_type'] == 'Scheduled Visit')
        {
            $participantVisit = ParticipantVisit::where('participant_id', 'LIKE', $formDetails['participant_id'])
                                ->where('visit_id', $formDetails['visit_id'])
                                ->first();
            return $participantVisit->id;
        }

        else {
            return null;
        }
    }
 
}