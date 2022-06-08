<?php

namespace App\Http\Livewire\Screening;

use App\Services\ScreeningService;
use Livewire\Component;
use Livewire\WithPagination;

class ViewScreenings extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function screeningService()
    {
        return new ScreeningService();
    }

    public function getAllScreeningRecords()
    {
        
    }

    public function render()
    {
        $screenings = $this->screeningService()
                            ->screeningRecords(auth()->id())
                            ->where('participant_id', 'like', '%'.$this->search.'%')
                            ->paginate(10);

        return view('livewire.screening.view-screenings',
                            ['screenings' => $screenings]);
    }
}
