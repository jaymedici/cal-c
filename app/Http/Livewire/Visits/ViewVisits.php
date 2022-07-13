<?php

namespace App\Http\Livewire\Visits;

use App\Services\ParticipantVisitsService;
use Livewire\Component;
use Livewire\WithPagination;

class ViewVisits extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function participantVisitService()
    {
        return new ParticipantVisitsService();
    }

    public function render()
    {
        $participantVisits = $this->participantVisitService()
                                ->scheduledVisitRecords(auth()->id())
                                ->paginate(10);

        return view('livewire.visits.view-visits', 
                        ['participantVisits' => $participantVisits]);
    }
}
