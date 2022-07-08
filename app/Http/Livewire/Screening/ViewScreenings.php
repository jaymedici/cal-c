<?php

namespace App\Http\Livewire\Screening;

use App\Models\Screening;
use App\Services\ScreeningService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ViewScreenings extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $projectId;
    public $search = '';
    public $screeningOutcome = '';
    public $screeningLabel = '';

    public $screening;

    public $edit_form_state = [];

    public function screeningService()
    {
        return new ScreeningService();
    }

    public function clearFilters()
    {
        $this->search = $this->screeningOutcome = $this->screeningLabel = '';
    }

    public function editScreening(Screening $screening)
    {
        $this->screening = $screening;
        $this->edit_form_state = $screening->toArray();

        $this->dispatchBrowserEvent('show-edit-screening-form');
    }

    public function deleteScreening(Screening $screening)
    {
        
    }

    public function updateScreening()
    {
        $data = $this->screeningService()
                     ->validateScreeningRecordUpdates($this->edit_form_state);
        $data['updated_by'] = Auth::user()->username;
        
        $this->screening->update($data);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Screening record updated Successfully!']);
    }

    public function render()
    {
        $screeningLabels = $this->screeningService()->getScreeningLabels($this->projectId);

        $screenings = $this->screeningService()
                            ->screeningRecords(auth()->id())
                            ->where('project_id', $this->projectId)
                            ->where('participant_id', 'LIKE', '%'.$this->search.'%')
                            ->where('screening_label', 'LIKE', '%'.$this->screeningLabel.'%')
                            ->where('screening_outcome', 'LIKE', '%'.$this->screeningOutcome.'%')
                            ->paginate(10);

        return view('livewire.screening.view-screenings',
                            ['screenings' => $screenings,
                             'screeningLabels' => $screeningLabels]);
    }
}
