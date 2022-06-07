<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use Livewire\WithPagination;

class ViewAssignedUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $project;

    public function render()
    {
        $assignedUsers = $this->project->users()->SimplePaginate(8);

        return view('livewire.projects.view-assigned-users', 
                        ['assignedUsers' => $assignedUsers]);
    }
}
