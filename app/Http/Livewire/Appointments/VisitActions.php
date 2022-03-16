<?php

namespace App\Http\Livewire\Appointments;

use Livewire\Component;

class VisitActions extends Component
{
    public $visitStatus;

    public function render()
    {
        return view('livewire.appointments.visit-actions');
    }
}
