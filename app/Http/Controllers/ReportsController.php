<?php

namespace App\Http\Controllers;
use App\Models\ParticipantVisit;
use App\Models\Site;
use App\Project;
use App\Services\ReportsService;
use Auth;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    protected $reportsService;

    public function __construct(ReportsService $service)
    {
        $this->middleware('auth');
        $this->reportsService = $service;
    }

    public function reportsByProject($projectId)
    {
        $visitOutcomeChart = $this->reportsService->makeVisitOutcomeChart($projectId);  

        return view('reports.reportsByProject', compact('visitOutcomeChart'));
    }

    
}
