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

    //Store an Appointment based on visit
    public function storeByVisit($participantVisitId, Request $request)
    {
        //
        $rules = [
           'participant_id' => 'required',
            'appointment_date_time' => 'required',
        ];

        $data = $request->validate($rules);

        //Check if a duplicate Appointment exists
        $appointment = Appointment::where('participant_id', 'LIKE', $data['participant_id'])
                                ->where('participant_visit_id', $participantVisitId)
                                ->count();

        if($appointment > 0)
        {
            return back()->with('error_message', 'Sorry! An appointment for this participant and visit already exists');
        }

        //
        $visit = ParticipantVisit::findOrFail($participantVisitId);
        $data['project_id'] = $visit->project_id;
        $data['site_id'] = 1;
        $data['participant_visit_id'] = $participantVisitId;
        $data['updated_by'] = Auth::user()->username;

        try{
            Appointment::create($data);
        }
        catch(\Exception $exception)
        {
            //dd($exception);
            return back()->withinput()->with('error_message','An Error Occured while saving data');
        }
        return redirect()->route('home')->with('success','Appointment created Successfully!');
    }

    public function setScreeningAppointment($screeningId, $appointmentDetails)
    {
        $data = $appointmentDetails;
        $data['screening_id'] = $screeningId;

        try{
            Appointment::create($data);
        }
        catch(\Exception $exception)
        {
            //dd($exception);
            return "Error";
        }

        return "Success";
    }

    public function deleteAppointment(Appointment $appointment)
    {
        $appointment->delete();
    }

}
