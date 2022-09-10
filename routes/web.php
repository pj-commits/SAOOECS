<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssignRoleController;

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

// for an authenticated user. = guest role
// Route::group(['middleware'=> ['auth']], function(){
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('users.dashboard');
// });


// Auth user -- Users dashboard
require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('_users.dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';

// Role managers == adviser, pres, sao
Route::group(['middleware'=> ['auth', 'role:moderator|editor|viewer']], function(){
    Route::resource('roles', AssignRoleController::class, ['names' => 'roles']);
    Route::post('roles/invite', [AssignRoleController::class, 'invite'])->name('invite');
});


//Below Are Test Route only
Route::get('records', function (){
    return view('_users.records')
        ->with("message", "Hello Records!");
})->name('records');

Route::get('submitted-forms', function (){
    return view('_approvers.submitted-forms')
        ->with("message", "Hello Submitted Forms!");
})->name('submitted-forms');

//Forms
Route::get('forms/activity-proposal-form', function (){
    return view('_student-organization.activity-proposal')
        ->with("message", "Hello APF!");
})->name('activity-proposal');

Route::get('forms/budget-requisition-form', function (){
    return view('_student-organization.budget-requisition')
        ->with("message", "Hello RF!");
})->name('budget-requisition');

Route::get('forms/narrative-report', function (){
    return view('_student-organization.narrative')
        ->with("message", "Hello NR!");
})->name('narrative');

Route::get('forms/liquidation-form', function (){
    return view('_student-organization.liquidation')
        ->with("message", "Hello LF!");
})->name('liquidation');


