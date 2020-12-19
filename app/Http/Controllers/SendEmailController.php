<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Use Charts;
use ConsoleTVs\Charts\Facades\Charts;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VisitExports;
use App\Calendar;
use App\VisitSetting;
use App\Project;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VisitNotification;

use App\Charts\DataChart;
use DB;


class SendEmailController extends Controller
{
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
 // Get users grouped by Visit Status
 $todaydate=date("Y-m-d");
 $visit=Calendar::where('windows_start_date','<=', $todaydate)
 ->where('windows_end_date','>=', $todaydate)
 ->where('visit_status', 'Pending')
 ->update([
   'visit_status1'=>'Pending and On Window',
   'visit_status'=>'Pending and On Window',
          ]);

 $visit=Calendar::where('windows_start_date','>', $todaydate)
           ->update([
             'visit_status1'=>'Pending',
   ]);  
   
   $visit=Calendar::where('windows_end_date','<', $todaydate)
   ->where('visit_status', 'Pending and On Window')
   ->update([
     'visit_status1'=>'Missed Visit',
     'visit_status1'=>'Missed Visit',
            ]);


 $filename = 'VisitCalculator.xlsx';
 Excel::store(new VisitExports, $filename);   
 $path = storage_path($filename);


//Send Email Notification
$file_path=storage_path('app/'.$filename);
//$requesterName = auth::user()->name;
$substituteEmail="pagrea16@gmail.com";
Notification::route('mail', $substituteEmail)
->notify(new VisitNotification($file_path));
return "Sent Without any Problem";
    }

    public function sendEmail()
    {
  
    }
}
