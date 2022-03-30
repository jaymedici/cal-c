<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DataChartController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParticipantVisitsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VisitChecklistsController;
use App\Http\Controllers\VisitSettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
return view('auth.login');
});

Auth::routes();
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('post-login', [App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('login.post');

Route::group(['middleware' => ['preventBackHistory','auth']],function()
        {
                Route::get('/projectData/{id}', [HomeController::class, 'projectData'])->name('projectData');
                Route::get('/home', [HomeController::class, 'index'])->name('home');
                Route::get('user',[UsersController::class, 'index'])->name('user.index');
                Route::get('userDatatable',[UsersController::class, 'userDatatable'])->name('userDatatable');
                Route::get('addprojecttouser',[UsersController::class, 'addprojecttouser'])->name('addprojecttouser');
                Route::get('removeprojecttouser',[UsersController::class, 'removeprojecttouser'])->name('removeprojecttouser');
                Route::resource('user',UsersController::class);
                Route::resource('departments',DepartmentController::class);
                Route::get('departmentDatatable',[DepartmentController::class, 'departmentDatatable'])->name('departmentDatatable');

                //Project Routes
                Route::resource('projects', ProjectsController::class);
                Route::get('projectDatatable',[ProjectsController::class, 'projectDatatable'])->name('projectDatatable');
                Route::get('projectListdt',[ProjectsController::class, 'projectListdt'])->name('projectListdt');

                Route::get('livewireTest',[ProjectsController::class, 'livewireTest'])->name('livewireTest');

                //Site Routes
                Route::resource('sites',SitesController::class);

                //Appointment Routes
                Route::resource('appointments',AppointmentsController::class);
                Route::get('appointments/createFromVisit/{visitId}',[AppointmentsController::class, 'createFromVisit'])->name('appointments.createFromVisit');
                Route::get('appointments/viewAppointment/{appointmentId}',[AppointmentsController::class, 'viewAppointment'])->name('appointments.viewAppointment');
                Route::post('appointments/storeByVisit/{visitId}',[AppointmentsController::class, 'storeByVisit'])->name('appointments.storeByVisit');

                //Calendar Routes
                Route::get('calendar/show',[CalendarController::class, 'show'])->name('calendar.show');

                //Reports/Charts Routes
                Route::get('reports/index',[ReportsController::class, 'index'])->name('reports.index');
                Route::get('reports/reportsByProject/{project}',[ReportsController::class, 'reportsByProject'])->name('reports.reportsByProject')
                        ->middleware('checkProjectAssignment');

                //Visit Settings Routes
                Route::resource('visits',VisitSettingsController::class);
                Route::get('visitsDatatable',[VisitSettingsController::class, 'visitsDatatable'])->name('visitsDatatable');
                Route::get('visits/createForProject/{project}',[VisitSettingsController::class, 'createForProject'])->name('visits.createForProject')
                        ->middleware('checkProjectAssignment');
                Route::post('visits/storeVisitsForProject/{project}',[VisitSettingsController::class, 'storeVisitsForProject'])->name('visits.storeVisitsForProject')
                        ->middleware('checkProjectAssignment');

                //Visit Checklist Routes
                Route::resource('visitChecklists',VisitChecklistsController::class);

                //Screening Routes
                Route::resource('screening',ScreeningController::class);
                Route::get('screening/getScreeningTypes/{project}',[ScreeningController::class, 'getScreeningTypes'])->name('screening.getScreeningTypes');
                Route::get('screening/getScreeningReturningParticipants/{project}',[ScreeningController::class, 'getScreeningReturningParticipants'])->name('screening.getScreeningReturningParticipants');

                //Participant Visits Routes
                Route::get('participantVisits/enrolmentIndex',[ParticipantVisitsController::class, 'enrolmentIndex'])->name('participantVisits.enrolmentIndex');
                Route::get('participantVisits/visitsIndex',[ParticipantVisitsController::class, 'visitsIndex'])->name('participantVisits.visitsIndex');
                Route::get('participantVisits/missedVisitsIndex', [ParticipantVisitsController::class, 'missedVisitsIndex'])->name('participantVisits.missedVisitsIndex');
                Route::get('participantVisits/projectVisitsIndex/{project}',[ParticipantVisitsController::class, 'projectVisitsIndex'])->name('participantVisits.projectVisitsIndex')
                        ->middleware('checkProjectAssignment');
                Route::get('participantVisits/projectMissedVisitsIndex/{project}',[ParticipantVisitsController::class, 'projectMissedVisitsIndex'])->name('participantVisits.projectMissedVisitsIndex')
                        ->middleware('checkProjectAssignment');
                Route::get('participantVisits/projectVisitsIndexDT/{project}',[ParticipantVisitsController::class, 'projectVisitsIndexDT'])->name('participantVisits.projectVisitsIndexDT');

                Route::get('participantVisits/createParticipant/{project}',[ParticipantVisitsController::class, 'createParticipant'])->name('participantVisits.createParticipant');
                Route::post('participantVisits/storeParticipant/{project}',[ParticipantVisitsController::class, 'storeParticipant'])->name('participantVisits.storeParticipant');

                Route::resource('roles',RolesController::class);
                Route::resource('dataCharts',DataChartController::class);
        });





