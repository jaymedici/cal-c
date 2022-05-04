<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Project;
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
    public $project;

    public function appointmentsService()
    {
        return new AppointmentsService();
    }

    public function getAppointments()
    {
        $projectId = $this->project;
        $appointments = $this->appointmentsService()->allAppointmentsLaterThanToday(Auth::id())
                                    ->where('participant_id', 'like', '%'.$this->search.'%')
                                    ->where(function ($query) use ($projectId) {
                                        if($projectId != null)
                                        {
                                            $query->where('project_id', $this->project);
                                        }
                                    }) 
                                    ->paginate(10);

        return $appointments;
    }

    public function getProjects()
    {
        $projectNames = array();
        $UniqueProjectIds = $this->appointmentsService()->allAppointmentsLaterThanToday(Auth::id())
                                    ->get()->unique('project_id')->pluck('project_id');
        
        foreach($UniqueProjectIds as $projectId)
        {
            $projectNames[] = Project::where('id', $projectId)->first();
        }

        return $projectNames;
    }

    public function render()
    {
        $appointments = $this->getAppointments();
        $projects = $this->getProjects();
        
        return view('livewire.appointments.view-appointments', [
            'appointments' => $appointments,
            'projects' => $projects
        ]);
    }
}
