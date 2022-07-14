<?php

namespace App\Http\Livewire\Visits;

use App\Services\ParticipantVisitsService;
use Livewire\Component;
use Livewire\WithPagination;

class ViewVisits extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $visitStatus = '';

    public function participantVisitService()
    {
        return new ParticipantVisitsService();
    }

    public function clearFilters()
    {
        $this->search = $this->visitStatus = '';
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
