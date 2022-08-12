<?php

namespace App\Http\Livewire\Visits;

use App\Models\ParticipantVisit;
use App\Services\ParticipantVisitsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ViewVisits extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $visitStatus = '';
    public $participantVisit;
    public $edit_form_state = [];

    public function participantVisitService()
    {
        return new ParticipantVisitsService();
    }

    public function clearFilters()
    {
        $this->search = $this->visitStatus = '';
    }

    public function editParticipantVisit(ParticipantVisit $participantVisit)
    {
        $this->participantVisit = $participantVisit;
        $this->edit_form_state['participant_id'] = $participantVisit->participant_id;
        $this->edit_form_state['visit_name'] = $participantVisit->visit->visit_name;
        $this->edit_form_state['visit_status'] = $participantVisit->visit_status;

        $this->dispatchBrowserEvent('show-edit-participant-visit-form');
    }

    public function updateParticipantVisitStatus()
    {
        $data = Validator::make($this->edit_form_state, [
            'visit_status' => 'required'
        ])->validate();

        $data['updated_by'] = Auth::user()->username;
        $data['marked_by'] = Auth::user()->username;

        $this->participantVisit->update($data);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Participant visit status updated Successfully!']);
    }

    public function render()
    {
        $participantVisits = $this->participantVisitService()
                                ->scheduledVisitRecords(auth()->id())
                                ->where('participant_id', 'LIKE', '%'.$this->search.'%')
                                ->where('visit_status', 'LIKE', '%'.$this->visitStatus.'%')
                                ->paginate(10);

        return view('livewire.visits.view-visits', 
                        ['participantVisits' => $participantVisits]);
    }
}
