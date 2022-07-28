<?php

namespace App\Http\Livewire\Home;

use App\Models\Appointment;
use App\Models\ParticipantVisit;
use App\Services\ParticipantVisitsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduledVisits extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $create_form_state = [];
    public $edit_form_state = [];

    public $participantVisit;

    public function setAppointment(ParticipantVisit $participantVisit)
    {
        $this->participantVisit = $participantVisit;
        $this->create_form_state = $participantVisit->toArray();

        $this->create_form_state['project_name'] = $participantVisit->project->name;
        $this->create_form_state['site_name'] = $participantVisit->site->site_name;
        //($this->create_form_state);

        $this->dispatchBrowserEvent('show-set-appointment-form');
    }

    public function changeAppointment(ParticipantVisit $participantVisit)
    {
        $this->participantVisit = $participantVisit;

        $this->edit_form_state['participant_visit_id'] = $participantVisit->id;
        $this->edit_form_state['participant_id'] = $participantVisit->participant_id;
        $this->edit_form_state['project_name'] = $participantVisit->project->name;
        $this->edit_form_state['site_name'] = $participantVisit->site->site_name;
        $this->edit_form_state['appointment_id'] = $participantVisit->appointment->id;
        $this->edit_form_state['appointment_date_time'] = $participantVisit->appointment->appointment_date_time;

        //dd($this->edit_form_state);

        $this->dispatchBrowserEvent('show-change-appointment-form');
    }

    public function saveAppointment()
    {
        //dd($this->participantVisit);
        $data = Validator::make($this->create_form_state, [
            'appointment_date_time' => 'required|after_or_equal:' .
            $this->participantVisit->window_start_date . '|before_or_equal:' .
            $this->participantVisit->window_end_date
        ])->validate();

        //dd($this->create_form_state);
        $data['participant_id'] = $this->create_form_state['participant_id'];
        $data['project_id'] = $this->create_form_state['project_id'];
        $data['site_id'] = $this->create_form_state['site_id'];
        $data['participant_visit_id'] = $this->create_form_state['id'];
        $data['updated_by'] = Auth::user()->username;
        //dd($data);

        Appointment::create($data);

        $this->emit('appointmentCreated');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Appointment Created Successfully!']);
    }

    public function updateAppointment()
    {
        $data = Validator::make($this->edit_form_state, [
            'appointment_date_time' => 'required|after_or_equal:' .
            $this->participantVisit->window_start_date . '|before_or_equal:' .
            $this->participantVisit->window_end_date
        ])->validate();

        //dd($this->edit_form_state);

        $appointmentToUpdate = Appointment::findOrFail($this->edit_form_state['appointment_id']);
        $appointmentToUpdate->update($data);

        $this->emit('appointmentCreated');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Appointment Changed Successfully!']);
    }

    public function render()
    {
        $scheduledParticipantVisits = ParticipantVisitsService::get2WeeksScheduledVisits(Auth::id())
                                                ->where('participant_id', 'like', '%'.$this->search.'%')
                                                ->paginate(5);

        return view('livewire.home.scheduled-visits', [
            'scheduledParticipantVisits' => $scheduledParticipantVisits,
        ]);
    }
}
