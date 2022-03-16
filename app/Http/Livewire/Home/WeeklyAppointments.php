<?php

namespace App\Http\Livewire\Home;

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WeeklyAppointments extends Component
{
    protected $listeners = [
        'appointmentCreated' => 'render'
    ];

    public function render()
    {
        //Get Appointments
        $appointmentsObject = new AppointmentsController();
        $appointmentsThisWeek = $appointmentsObject->getAppointmentsThisWeek(Auth::id());

        return view('livewire.home.weekly-appointments', [
            'appointmentsThisWeek' => $appointmentsThisWeek,
        ]);
    }
}
