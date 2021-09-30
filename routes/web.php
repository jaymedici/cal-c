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
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/sendEmail', [App\Http\Controllers\SendEmailController::class, 'index'])->name('sendEmail');

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

Route::resource('projects',App\Http\Controllers\ProjectsController::class);
Route::get('projectDatatable',[App\Http\Controllers\ProjectsController::class, 'projectDatatable'])->name('projectDatatable');
Route::get('projectListdt',[App\Http\Controllers\ProjectsController::class, 'projectListdt'])->name('projectListdt');



Route::resource('visits',App\Http\Controllers\VisitSettingsController::class);
Route::get('visitsDatatable',[App\Http\Controllers\VisitSettingsController::class, 'visitsDatatable'])->name('visitsDatatable');

Route::resource('calculators',App\Http\Controllers\CalculatorController::class);
Route::get('calculatorsDatatable',[App\Http\Controllers\CalculatorController::class, 'calculatorsDatatable'])->name('calculatorsDatatable');
Route::get('projectdt/{id}',[App\Http\Controllers\CalculatorController::class, 'projectdt']);
Route::get('PendingOnWindow',[App\Http\Controllers\CalculatorController::class, 'PendingOnWindow'])->name('PendingOnWindow');

Route::get('passedvisits',[App\Http\Controllers\CalculatorController::class, 'passedvisits'])->name('passedvisits');
Route::get('passedvisitsDatatable',[App\Http\Controllers\CalculatorController::class, 'passedvisitsDatatable'])->name('passedvisitsDatatable');

Route::get('todayVisits',[App\Http\Controllers\CalculatorController::class, 'todayVisits'])->name('todayVisits');
Route::get('todayVisitsDatatable',[App\Http\Controllers\CalculatorController::class, 'todayVisitsDatatable'])->name('todayVisitsDatatable');

Route::get('missedVisits',[App\Http\Controllers\CalculatorController::class, 'missedVisits'])->name('missedVisits');
Route::get('missedVisitsDatatable',[App\Http\Controllers\CalculatorController::class, 'missedVisitsDatatable'])->name('missedVisitsDatatable');

Route::get('commingVisits',[App\Http\Controllers\CalculatorController::class, 'commingVisits'])->name('commingVisits');
Route::get('commingVisitsDatatable',[App\Http\Controllers\CalculatorController::class, 'commingVisitsDatatable'])->name('commingVisitsDatatable');

Route::resource('roles',App\Http\Controllers\RolesController::class);
Route::resource('dataCharts',App\Http\Controllers\DataChartController::class);

});





