<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\ParticipantVisit;
use Auth;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    public function getAppointmentsThisWeek($userId)
    {
        $datetoday = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
        $weekendDate = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now()->endOfWeek());

        $appointments = Appointment::whereHas('project', function ($query) use ($userId) {
                    $query->whereHas('assignees', function ($query2) use ($userId) {
                        $query2->where('user_id', $userId);
                    });
                })
                ->whereBetween('appointment_date_time', [$datetoday, $weekendDate])
                ->get();

        return $appointments;
    }

    public function createFromVisit($visitId)
    {
        $visit = ParticipantVisit::findOrFail($visitId);

        return view('appointments.createFromVisit', compact('visit'));
    }

    public function createFromScreening($screeningId)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
