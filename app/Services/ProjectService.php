<?php

namespace App\Services;

use App\Http\Controllers\ReportsController;
use App\Project;

class ProjectService
{

    /**
     * Checks if duplicate project name exists
     * 
     * @param string $name
     * 
     */
    public function checkIfDuplicateProjectNameExists($name)
    {
        $project = Project::where('name', $name)->count();

        if($project > 0)
        {
            return back()->withinput()->with('error_message','Error Occured, This Project already exists, Please check your Entry and Try again, or Contact IT team for help');
        }
    }

    public function formatScreeningVisitLabels($screeningVisitLabels)
    {
        if(is_array($screeningVisitLabels))
        {
            return implode(";", $screeningVisitLabels);
        }

        return $screeningVisitLabels;
    }

    public function getShowPageVariables(Project $project)
    {
        $pageVariables = array();

        $pageVariables['vChart'] = ReportsService::makeVisitOutcomeChart($project->id);

        $pageVariables['screenedNo'] = $project->screenedParticipants()->count(); 
        $pageVariables['enroledNo'] = $project->enrolledParticipants()->count();

        $pageVariables['pendingVisits'] = $project->pendingParticipantVisits()->count();
        $pageVariables['completedVisits'] = $project->completedParticipantVisits()->count();
        $pageVariables['missedVisits'] = $project->missedParticipantVisits()->count();
        $pageVariables['lostVisits'] = $project->lostParticipantVisits()->count();

        $pageVariables['lostVisits'] = $project->lostParticipantVisits()->count();

        $pageVariables['sites'] = $project->sites()->get();
        $pageVariables['users'] = $project->users()->get();

        return $pageVariables;
    }
}