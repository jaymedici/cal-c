<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;

class CreateVisitsForProject extends Component
{
    public $project;
    public $visits = [];

    public function mount($project)
    {
        $this->project = $project;
    }

    public function addVisit()
    {
        array_push($this->visits, '');
    }

    public function removeVisit($index)
    {
        unset($this->visits[$index]);
        $this->visits = array_values($this->visits);
    }

    public function saveVisits()
    {

    }

    public function render()
    {
        return view('livewire.visits.create-visits-for-project', [
            'project' => $this->project,
        ]);
    }
}
