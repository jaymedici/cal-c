<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\ParticipantVisit;
use App\Models\Screening;
use App\Models\Site;
use App\Project;
use App\Services\AppointmentsService;
use App\Services\ScreeningService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ViewAppointments extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $projectId;

    public $search = '';
    public $project;
    public $participantVisits = [];

    public $create_form_state = [];

    public $proceed;

    public function appointmentsService()
    {
        return new AppointmentsService();
    }

    public function screeningService()
    {
        return new ScreeningService();
    }

    public function createAppointment()
    {
        $this->dispatchBrowserEvent('show-create-appointment-form');
    }

    public function saveAppointment()
    {
        $formDetails = $this->create_form_state;
        $this->proceed = true;

        $data = $this->appointmentsService()->loadCreateAppointmentValidationRules($formDetails);
        $data->validate();
            
        $this->checkIfParticipantWithNoIdIsAssignedToNonScreeningVisit($formDetails);
        
        if($this->proceed)
        $this->checkIfSelectedVisitTypeRequiresParticipantEnrolment($formDetails);

        if($this->proceed)
        $this->checkIfSelectedDateIsWithinWindow($formDetails);

        if($this->proceed)
        {
            $formDetails['participant_visit_id'] = $this->appointmentsService()
                        ->getCorrespondingParticipantVisitId($formDetails);
            $formDetails['updated_by'] = Auth::user()->username;
            $formDetails['project_id'] = $this->projectId;

            Appointment::create($formDetails);

            $this->dispatchBrowserEvent('hide-form', ['message' => 'Appointment Created Successfully!']);
        }  
    }

    public function checkIfParticipantWithNoIdIsAssignedToNonScreeningVisit(array $formDetails)
    {
        if($formDetails['participant_id'] == 'No ID yet' && 
            $formDetails['visit_type'] != 'Screening')
        {
            session()->flash('message', 'Sorry! A participant with no registered ID can only come for screening!');
            $this->proceed = false;
        }
    }

    public function checkIfSelectedVisitTypeRequiresParticipantEnrolment(array $formDetails)
    {
        if($formDetails['visit_type'] == 'Scheduled Visit' || $formDetails['visit_type'] == 'Unscheduled Visit')
        {
            $participantVisits = ParticipantVisit::where('participant_id', 'LIKE', $formDetails['participant_id'])
                                                    ->get();

            if($participantVisits->isEmpty())
            {
                session()->flash('message', 'Sorry! The Participant you selected has not yet been enrolled!');
                $this->proceed = false;
            }
        }
    }

    public function checkIfSelectedDateIsWithinWindow(array $formDetails)
    {
        if($formDetails['visit_type'] == 'Scheduled Visit')
        {
            $participantVisit = ParticipantVisit::where('participant_id', 'LIKE', $formDetails['participant_id'])
                                                ->where('visit_id', $formDetails['visit_id'])
                                                ->first();

            if($formDetails['appointment_date_time'] < $participantVisit->window_start_date ||
                $formDetails['appointment_date_time'] > $participantVisit->validatable_end_date)
            {
                session()->flash('message', 'Sorry! The appointment date you chose is not within the participant visit window!');
                $this->proceed = false;
            }
        }
    }

    public function getAppointments()
    {
        $projectId = $this->project;
        $appointments = $this->appointmentsService()->allAppointmentsLaterThanToday(Auth::id())
                                    ->where('project_id', $this->projectId)
                                    ->where('participant_id', 'like', '%'.$this->search.'%')
                                    ->where(function ($query) use ($projectId) {
                                        if($projectId != null)
                                        {
                                            $query->where('project_id', $this->project);
                                        }
                                    }) 
                                    ->paginate(10);

        return $appointments;
    }

    public function getUserAssignedSites()
    {
        return Site::whereAssignedTo(auth()->id())->get();
    }

    public function getParticipantIDs()
    {
        return Screening::where('project_id', $this->projectId)
                        ->whereSiteAssignedTo(auth()->id())
                        ->get()
                        ->unique('participant_id')
                        ->pluck('participant_id');
    }

    public function getParticipantVisitNames($participantId)
    {
        $participantVisits = [];
        $allParticipantVisits = ParticipantVisit::with('visit')
                                ->where('participant_id', 'LIKE', $participantId)
                                ->get();

        foreach($allParticipantVisits as $participantVisit)
        {
            $participantVisits['id'] = $participantVisit->id;
            $participantVisits['visit_name'] = $participantVisit->visit->visit_name;
        }

        $this->participantVisits = $participantVisits;
        dd($this->participantVisits);
    }

    public function render()
    {
        $project = Project::with('visits')->findOrFail($this->projectId);
        $appointments = $this->getAppointments();
        $sites = $this->getUserAssignedSites();
        $projectName = $project->name;
        $participantIds = $this->getParticipantIDs();
        $screeningLabels = $this->screeningService()->getScreeningLabels($this->projectId);
        $projectVisits = $project->visits;
        
        return view('livewire.appointments.view-appointments', [
            'appointments' => $appointments,
            'sites' => $sites,
            'projectName' => $projectName,
            'participantIds' => $participantIds,
            'screeningLabels' => $screeningLabels,
            'projectVisits' => $projectVisits
        ]);
    }
}
