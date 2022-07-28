<?php

namespace App\Http\Livewire\Participants;

use App\Models\EnrolledParticipant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ViewEnrolledParticipants extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $project;
    public $enrolledParticipant;
    public $search = '';

    public $edit_form_state = [];

    public function changeStudyArm(EnrolledParticipant $enrolledParticipant)
    {
        $this->enrolledParticipant = $enrolledParticipant;
        $this->edit_form_state = $enrolledParticipant->toArray();

        $this->dispatchBrowserEvent('show-change-study-arm-form');
    }

    public function updateParticipantStudyArm()
    {
        $data = Validator::make($this->edit_form_state, [
            'study_arm_id' => 'required',
        ])->validate();

        $data['updated_by'] = Auth::user()->username;

        $this->enrolledParticipant->update($data);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Participant details updated Successfully!']);
    }

    public function getEnrolledParticipants()
    {
        return EnrolledParticipant::where('project_id', $this->project->id)
                                    ->where('participant_id', 'like', '%'.$this->search.'%')
                                    ->whereSiteAssignedTo(auth()->id())
                                    ->with('site')
                                    ->with('studyArm')
                                    ->paginate(15);
    }

    public function render()
    {
        $enrolledParticipants = $this->getEnrolledParticipants();

        return view('livewire.participants.view-enrolled-participants', [
            'project' => $this->project,
            'enrolledParticipants' => $enrolledParticipants
        ]);
    }
}
