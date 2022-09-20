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

// LOGIN: Auto redirect
Route::get('/', function () {
    return view('auth.login');
});

// DASHBOARD: For Auth Users
require __DIR__.'/auth.php';
Route::get('/', function () {
    return view('_users.dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';

// ROLE TAB: Role managers/moderators == adviser, pres, sao
Route::group(['middleware'=> ['auth', 'role:moderator']], function(){
    Route::get('roles/invite', [AssignRoleController::class, 'invite'])->name('roles.invite');
    Route::post('roles', [AssignRoleController::class, 'store'])->name('roles.store');

    Route::get('roles/{member}/edit', [AssignRoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{member}', [AssignRoleController::class, 'update'])->name('roles.update');

    Route::get('roles/{member}/del', [AssignRoleController::class, 'del'])->name('roles.del');
    Route::delete('roles/del/{member}', [AssignRoleController::class, 'destroy'])->name('roles.destroy');
});
Route::group(['middleware'=> ['auth', 'role:moderator|editor|viewer']], function(){
    Route::get('roles', [AssignRoleController::class, 'index'])->name('roles.index');
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


