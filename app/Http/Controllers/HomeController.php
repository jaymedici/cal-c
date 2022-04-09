<?php
namespace App\Http\Controllers;

use App\Services\AppointmentsService;
use Illuminate\Http\Request;


class HomeController extends Controller
{
  protected $apptService;

  public function __construct(AppointmentsService $apptService)
  {
      $this->middleware('auth');
      $this->apptService = $apptService;
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    $userAssignedProjects = auth()->user()->projects()->get();
    $appointmentsNoToday = $this->apptService->countAppointmentsToday(auth()->user()->id);
   
    return view('home', compact('userAssignedProjects', 'appointmentsNoToday'));
  }

}
