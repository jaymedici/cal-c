<?php

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
/*
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout');
*/
//Authentication Routes
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('post-login', [App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('login.post');
//Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/sendEmail', [App\Http\Controllers\SendEmailController::class, 'index'])->name('sendEmail');

//User Control Routes
Route::group(['middleware' => ['preventBackHistory','auth']],function(){
Route::get('/projectData/{id}', [App\Http\Controllers\HomeController::class, 'projectData'])->name('projectData');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth::routes();
Route::get('user',[App\Http\Controllers\UsersController::class, 'index'])->name('user.index');
Route::get('userDatatable',[App\Http\Controllers\UsersController::class, 'userDatatable'])->name('userDatatable');
Route::get('addprojecttouser',[App\Http\Controllers\UsersController::class, 'addprojecttouser'])->name('addprojecttouser');
Route::get('removeprojecttouser',[App\Http\Controllers\UsersController::class, 'removeprojecttouser'])->name('removeprojecttouser');
Route::resource('user',App\Http\Controllers\UsersController::class);
Route::resource('departments',App\Http\Controllers\DepartmentController::class);
Route::get('departmentDatatable',[App\Http\Controllers\DepartmentController::class, 'departmentDatatable'])->name('departmentDatatable');

//Project Routes
Route::resource('projects',App\Http\Controllers\ProjectsController::class);
Route::get('projectDatatable',[App\Http\Controllers\ProjectsController::class, 'projectDatatable'])->name('projectDatatable');
Route::get('projectListdt',[App\Http\Controllers\ProjectsController::class, 'projectListdt'])->name('projectListdt');

Route::get('livewireTest',[App\Http\Controllers\ProjectsController::class, 'livewireTest'])->name('livewireTest');

//Site Routes
Route::resource('sites',App\Http\Controllers\SitesController::class);

//Appointment Routes
Route::resource('appointments',App\Http\Controllers\AppointmentsController::class);
Route::get('appointments/createFromVisit/{visitId}',[App\Http\Controllers\AppointmentsController::class, 'createFromVisit'])->name('appointments.createFromVisit');
Route::get('appointments/viewAppointment/{appointmentId}',[App\Http\Controllers\AppointmentsController::class, 'viewAppointment'])->name('appointments.viewAppointment');
Route::post('appointments/storeByVisit/{visitId}',[App\Http\Controllers\AppointmentsController::class, 'storeByVisit'])->name('appointments.storeByVisit');

//Calendar Routes
Route::get('calendar/show',[App\Http\Controllers\CalendarController::class, 'show'])->name('calendar.show');

//Reports/Charts Routes
Route::get('reports/index',[App\Http\Controllers\ReportsController::class, 'index'])->name('reports.index');
Route::get('reports/reportsByProject/{project}',[App\Http\Controllers\ReportsController::class, 'reportsByProject'])->name('reports.reportsByProject')
            ->middleware('checkProjectAssignment');

//Visit Settings Routes
Route::resource('visits',App\Http\Controllers\VisitSettingsController::class);
Route::get('visitsDatatable',[App\Http\Controllers\VisitSettingsController::class, 'visitsDatatable'])->name('visitsDatatable');
Route::get('visits/createForProject/{project}',[App\Http\Controllers\VisitSettingsController::class, 'createForProject'])->name('visits.createForProject')
        ->middleware('checkProjectAssignment');
Route::post('visits/storeVisitsForProject/{project}',[App\Http\Controllers\VisitSettingsController::class, 'storeVisitsForProject'])->name('visits.storeVisitsForProject')
        ->middleware('checkProjectAssignment');

//Visit Checklist Routes
Route::resource('visitChecklists',App\Http\Controllers\VisitChecklistsController::class);

//Screening Routes
Route::resource('screening',App\Http\Controllers\ScreeningController::class);
Route::get('screening/getScreeningTypes/{project}',[App\Http\Controllers\ScreeningController::class, 'getScreeningTypes'])->name('screening.getScreeningTypes');
Route::get('screening/getScreeningReturningParticipants/{project}',[App\Http\Controllers\ScreeningController::class, 'getScreeningReturningParticipants'])->name('screening.getScreeningReturningParticipants');

//Participant Visits Routes
Route::get('participantVisits/enrolmentIndex',[App\Http\Controllers\ParticipantVisitsController::class, 'enrolmentIndex'])->name('participantVisits.enrolmentIndex');
Route::get('participantVisits/visitsIndex',[App\Http\Controllers\ParticipantVisitsController::class, 'visitsIndex'])->name('participantVisits.visitsIndex');
Route::get('participantVisits/projectVisitsIndex/{project}',[App\Http\Controllers\ParticipantVisitsController::class, 'projectVisitsIndex'])->name('participantVisits.projectVisitsIndex')
        ->middleware('checkProjectAssignment');
Route::get('participantVisits/projectVisitsIndexDT/{project}',[App\Http\Controllers\ParticipantVisitsController::class, 'projectVisitsIndexDT'])->name('participantVisits.projectVisitsIndexDT');
Route::get('participantVisits/createParticipant/{project}',[App\Http\Controllers\ParticipantVisitsController::class, 'createParticipant'])->name('participantVisits.createParticipant');
Route::post('participantVisits/storeParticipant/{project}',[App\Http\Controllers\ParticipantVisitsController::class, 'storeParticipant'])->name('participantVisits.storeParticipant');

Route::resource('roles',App\Http\Controllers\RolesController::class);
Route::resource('dataCharts',App\Http\Controllers\DataChartController::class);

});





