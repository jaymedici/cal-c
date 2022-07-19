<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\ParticipantVisit;
use App\Project;
use Auth;

class AppointmentsController extends Controller
{
    public function index()
    {
        $assignedProjects = Project::whereAssignedTo(auth()->id())->paginate(7);

        return view('appointments.index', compact('assignedProjects'));
    }

    public function viewAppointments($projectId)
    {
        return view('appointments.viewAppointments', compact('projectId'));
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
