<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Services\AppointmentsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewAppointments extends Component
{
    public function render()
    {
        $service = new AppointmentsService();

        $appointments = $service->allAppointmentsLaterThanToday(Auth::id())
                                    ->get();
        
        return view('livewire.appointments.view-appointments', [
            'appointments' => $appointments,
        ]);
    }
}
