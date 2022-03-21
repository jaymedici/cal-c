<?php

namespace App\Http\Livewire\Appointments;

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use App\Models\ParticipantVisit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VisitActions extends Component
{
    public $appointment;
    public $form_state = [];

    public function saveVisitAction(Appointment $appointment)
    {
        $participantVisit = ParticipantVisit::findOrFail($appointment->participant_visit_id);
        $data = $this->validateData($this->form_state, $participantVisit);

        $participantVisit->update($data);
        (new AppointmentsController)->deleteAppointment($appointment);
        
        return redirect()->route('home')->with('success', 'Visit action Saved Successfully!');
    }

    public function validateData($form_state, ParticipantVisit $participantVisit)
    {
        $data = Validator::make($form_state, [
            'visit_status' => 'required',
            'actual_visit_date' => 'required_if:visit_status,Completed|
            after_or_equal:' . $participantVisit->window_start_date . 
            '|before_or_equal:' . $participantVisit->window_end_date
        ])->validate();
        
        $data['marked_date'] = Carbon::now()->toDateString();
        $data['marked_by'] = Auth::user()->username;

        return $data;
    }

    public function render()
    {
        return view('livewire.appointments.visit-actions');
    }
}
