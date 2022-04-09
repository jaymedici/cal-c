<?php

namespace App\Http\Livewire\Home;

use App\Http\Controllers\AppointmentsController;
use App\Services\AppointmentsService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WeeklyAppointments extends Component
{
    protected $listeners = [
        'appointmentCreated' => 'render'
    ];

    protected $service;

    public function mount(AppointmentsService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        $appointmentsThisWeek = $this->service->getAppointmentsThisWeek(Auth::id());

        return view('livewire.home.weekly-appointments', [
            'appointmentsThisWeek' => $appointmentsThisWeek,
        ]);
    }
}
