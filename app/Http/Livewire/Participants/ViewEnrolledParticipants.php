<?php

namespace App\Http\Livewire\Participants;

use App\Models\EnrolledParticipant;
use Livewire\Component;
use Livewire\WithPagination;

class ViewEnrolledParticipants extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $project;
    public $search = '';

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
