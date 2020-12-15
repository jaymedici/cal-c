<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Use Charts;
use ConsoleTVs\Charts\Facades\Charts;
use App\Calendar;
use App\VisitSetting;
use App\Project;

use App\Charts\DataChart;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
  // Get users grouped by Visit Status
  $project = Project::all();
  $groups = DB::table('calendars')->select('visit_status', DB::raw('count(*) as total'))
  ->groupBy('visit_status')->pluck('total', 'visit_status')->all();

  $groups1 = DB::table('calendars')->select('visit', DB::raw('count(*) as total'))
  ->where('visit_status', 'Pending and On Window')
  ->groupBy('visit')->pluck('total', 'visit')->all();
 
 // Generate random colours for the groups
 for ($i=0; $i<=count($groups); $i++) {
 $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
 }
 // Prepare the data for returning with the view
 $chart = new DataChart;
 $chart->labels = (array_keys($groups));
 $chart->dataset = (array_values($groups));
 $chart->colours = $colours;

 $chart1 = new DataChart;
 $chart1->labels = (array_keys($groups1));
 $chart1->dataset = (array_values($groups1));
 $chart1->colours = $colours;

 return view('home', compact('chart','project','chart1'));
    }


    public function projectData($id)
    {
  // Get users grouped by Visit Status
  $project = Project::find($id);
  $visit = Calendar::where('project_id', $id)->where('visit_status', 'Pending and On Window');
  $groups = DB::table('calendars')->select('visit_status', DB::raw('count(*) as total'))
  ->where('project_id', $id)
  ->groupBy('visit_status')->pluck('total', 'visit_status')->all();

  $groups1 = DB::table('calendars')->select('visit', DB::raw('count(*) as total'))
  ->where('project_id', $id)
  ->where('visit_status', 'Pending and On Window')
  ->groupBy('visit')->pluck('total', 'visit')->all();
 
 // Generate random colours for the groups
 for ($i=0; $i<=count($groups); $i++) {
 $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
 }
 // Prepare the data for returning with the view
 $chart = new DataChart;
 $chart->labels = (array_keys($groups));
 $chart->dataset = (array_values($groups));
 $chart->colours = $colours;

 $chart1 = new DataChart;
 $chart1->labels = (array_keys($groups1));
 $chart1->dataset = (array_values($groups1));
 $chart1->colours = $colours;

 return view('visitcalculator.projectData', compact('chart','visit','project','chart1'));
    }

}
