<?php

namespace App\Http\Livewire\ParticipantVisits;

use App\Models\ParticipantVisit;
use App\Project;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ViewAllParticipantVisits extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $projectId;

    public $search = '';

    public function mount($projectId)
    {
        $this->projectId = $projectId;
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1); 
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function render()
    {
        $project = Project::with('visits')->with('participantVisits')->findOrFail($this->projectId);

        //Get all unique participants
        $participants = ParticipantVisit::where('project_id', $this->projectId)
                            ->where('participant_id', 'like', '%'.$this->search.'%')
                            ->get()->unique('participant_id')
                            ->pluck('participant_id');

        if ($participants->isNotEmpty())
        {
            foreach($participants as $participant)
            { 
                foreach($project->visits as $visit)
                {
                    $visitSchedule[$participant][$visit->id] = ParticipantVisit::with('visit')->where('project_id', $this->projectId)->where('visit_id', $visit->id)
                                    ->where('participant_id', 'LIKE', $participant)->first();
                }    
            }
        }
        
        else {
            $visitSchedule = null;
        }

        $participants = $this->paginate($participants);

        return view('livewire.participant-visits.view-all-participant-visits', [
            'project' => $project,
            'participants' => $participants,
            'visitSchedule' => $visitSchedule
        ]);
    }
}
