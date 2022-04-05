<?php

namespace App\Services;

use App\Models\ParticipantVisit;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ReportsService 
{
    public static function makeVisitOutcomeChart($projectId)
    {
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