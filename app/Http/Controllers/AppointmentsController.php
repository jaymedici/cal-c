<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\ParticipantVisit;
use Auth;

class AppointmentsController extends Controller
{
    public function index()
    {
        return view('appointments.index');
    }
    
    public function createFromVisit($visitId)
    {
        $visit = ParticipantVisit::findOrFail($visitId);

        return view('appointments.createFromVisit', compact('visit'));
    }

    public function createFromScreening($screeningId)
    {

    }

    public function viewAppointment($appointmentId)
    {
        $appointment = Appointment::with('project')
                                    ->with('participantVisit')
                                    ->with('screening')
                                    ->findOrFail($appointmentId);

        return view('appointments.viewAppointment', compact('appointment'));
    }

    public function deleteAppointment(Appointment $appointment)
    {
        $appointment->delete();
    }

}
