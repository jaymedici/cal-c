<?php

namespace App\Http\Controllers;
use App\Models\ParticipantVisit;
use App\Models\Site;
use App\Project;
use Auth;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Charts\TestChart;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::whereHas('assignees', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();

        

        return view('reports.index', compact('projects'));
    }

    public function reportsByProject($projectId)
    {
        $visitOutcomeChart = $this->makeVisitOutcomeChart($projectId);  

        return view('reports.reportsByProject', compact('visitOutcomeChart'));
    }

    public function makeVisitOutcomeChart($projectId)
    {
        //Get Visit Outcome Counts
        $visitOutcomeArray = array(
            'completedVisits' => "Completed",
            'pendingVisits' => "Pending",
            'missedVisits' => "Missed",
            'lostToFollowUp' => "Lost to follow up",
        );

        foreach($visitOutcomeArray as $variable => $visitStatus)
        {
            $$variable = ParticipantVisit::where('project_id', $projectId)
                            ->where('visit_status', 'LIKE', $visitStatus)
                            ->count();
        }

        //Visit Outcome Bar Chart
        $visitOutcomeChart = new LarapexChart;
        $visitOutcomeChart->setType('bar');
        $visitOutcomeChart->setDataset([
            [
                'data' => [$pendingVisits, $completedVisits, $missedVisits, $lostToFollowUp]
                ]
        ]);
        $visitOutcomeChart->setXAxis(['Pending', 'Completed', 'Missed', 'Lost to follow up']);
        $visitOutcomeChart->setHeight(350);

        return $visitOutcomeChart;
    }
}
