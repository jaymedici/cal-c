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
use App\Models\ParticipantVisit;
use App\Models\Screening;
use App\Charts\DataChart;
use DB;
use App\Http\Controllers\ParticipantVisitsController;
use App\Http\Controllers\AppointmentsController;


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

      if ((Auth::user()->user_active) != 'Yes') {
        echo '<script>alert("Your Account Was not Activeted, Please Contact The supper Admin User to activate it")</script>';
         Auth::logout();
         return view('auth.login');
      }

      //Get Scheduled Visits
      $visitsObject = new ParticipantVisitsController();
      $scheduledParticipantVisits = $visitsObject->get2WeeksScheduledVisits(Auth::id());

      //Get Appointments
      $appointmentObject = new AppointmentsController();
      $appointmentsThisWeek = $appointmentObject->getAppointmentsThisWeek(Auth::id());
      //dd($appointmentsThisWeek);

      //Get info Boxes Values for projects assigned, participants screened and those enrolled
      $numberOfParticipantsScreened = [];
      $numberOfParticipantsEnrolled = [];

      $projectsAssigned = Project::isAssigned(Auth::id())->get();
                          
      $projectsAssignedCount = Project::isAssigned(Auth::id())->count();

      foreach($projectsAssigned as $project)
      {
        $numberOfParticipantsEnrolled[$project->id] = ParticipantVisit::where('project_id', $project->id)->get()->unique('participant_id')->count();
        $numberOfParticipantsScreened[$project->id] = Screening::where('project_id', $project->id)->get()->unique('participant_id')->count();
      }

      return view('home', compact('projectsAssigned', 'projectsAssignedCount', 'numberOfParticipantsEnrolled', 'numberOfParticipantsScreened',
                  'scheduledParticipantVisits', 'appointmentsThisWeek'));
    }

}
