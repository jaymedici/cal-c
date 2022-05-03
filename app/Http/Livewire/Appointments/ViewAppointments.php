<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Services\AppointmentsService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ViewAppointments extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        $service = new AppointmentsService();

        $appointments = $service->allAppointmentsLaterThanToday(Auth::id())
                                    ->where('participant_id', 'like', '%'.$this->search.'%')
                                    ->paginate(10);
        
        return view('livewire.appointments.view-appointments', [
            'appointments' => $appointments,
        ]);
    }
}
