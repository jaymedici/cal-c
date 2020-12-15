<?php

namespace App\Http\Controllers;
use App\Charts\DataChart;
use Illuminate\Http\Request;
use DB;

class DataChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Get users grouped by Visit Status
$groups = DB::table('calendars')
->select('visit_status', DB::raw('count(*) as total'))
->groupBy('visit_status')
->pluck('total', 'visit_status')->all();
// Generate random colours for the groups
for ($i=0; $i<=count($groups); $i++) {
$colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
}
// Prepare the data for returning with the view
$chart = new DataChart;
$chart->labels = (array_keys($groups));
$chart->dataset = (array_values($groups));
$chart->colours = $colours;


     // Get users grouped by Visits
     $groups1 = DB::table('calendars')
     ->select('visit', DB::raw('count(*) as total'))
     ->groupBy('visit')
     ->pluck('total', 'visit')->all();
     // Generate random colours for the groups
     for ($i=0; $i<=count($groups1); $i++) {
     $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
     }
     // Prepare the data for returning with the view
     $chart1 = new DataChart;
     $chart1->labels = (array_keys($groups1));
     $chart1->dataset = (array_values($groups1));
     $chart1->colours = $colours;
return view('charts.datacharts', compact('chart','chart1'));
}
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
