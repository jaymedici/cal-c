<?php

namespace App\Services;

use App\Models\VisitSetting;
use App\Project;
use Illuminate\Support\Facades\Auth;

class VisitSettingsService
{
    public function checkIfProjectHasVisits(Project $project)
    {
        if(!$project->visits->isEmpty())
        {
            return back()->withinput()->with('error_message','Could not Complete your request since visits already exist for this project');
        }
    }

    public function makeVisitsArray(array $data)
    {
        $visits = array();
        $i = $j = $k = $l = $m = 1;

        foreach($data['visit_names'] as $key => $visit_name)
        {
            $visits[$i++]['visit_name'] = $visit_name;
        }
        foreach($data['days_from_first_visit'] as $key => $days_from_first_visit)
        {
            $visits[$j++]['days_from_first_visit'] = $days_from_first_visit;
        }
        foreach($data['plus_window_periods'] as $key => $plus_window_period)
        {
            $visits[$k++]['plus_window_period'] = $plus_window_period;
        }
        foreach($data['minus_window_periods'] as $key => $minus_window_period)
        {
            $visits[$l++]['minus_window_period'] = $minus_window_period;
        }

        return $visits;
    }

    public function makeFirstVisitAttributes(Project $project, string $visit1Label)
    {
        $data['project_id'] = $project->id;
        $data['visit_name'] = $visit1Label;
        $data['days_from_first_visit'] = 0;
        $data['plus_window_period'] = 0;
        $data['minus_window_period'] = 0;
        $data['updated_by'] = Auth::user()->username;

        return $data;
    }

    public function massCreate(Project $project, array $visits)
    {
        foreach($visits as $visit)
        {
            $data['project_id'] = $project->id;
            $data['visit_name'] = $visit['visit_name'];
            $data['days_from_first_visit'] = $visit['days_from_first_visit'];
            $data['plus_window_period'] = $visit['plus_window_period'];
            $data['minus_window_period'] = $visit['minus_window_period'];
            $data['visit_type'] = "Regular";
            $data['updated_by'] = Auth::user()->username;

            VisitSetting::create($data);
        }
    }
}