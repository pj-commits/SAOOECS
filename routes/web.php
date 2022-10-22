<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LFController;
use App\Http\Controllers\RFController;
use App\Http\Controllers\APFController;
use App\Http\Controllers\NRController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SubmittedFormsController;
use App\Http\Controllers\TestController;
use App\Mail\apfSubmittedEmail;
use App\Mail\rfSubmittedEmail;
use App\Mail\nrSubmittedEmail;
use App\Mail\lfSubmittedEmail;
use App\Mail\OrgMemAddEmail;

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



Route::get('test-test', [TestController::class, 'index'])->name('test-test');
Route::post('test-test-test', [TestController::class, 'store'])->name('test-store');

/*
|--------------------------------------------------------------------------
| Dashboard Tab - Submitted Forms Tab - Records Tab
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard',  [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard/cancel-form',  [DashboardController::class, 'cancel'])->name('dashboard.cancel');
    Route::get('submitted-forms', [SubmittedFormsController::class, 'index'])->middleware('isApprover')->name('submitted-forms');
    Route::get('records', [RecordsController::class, 'index'])->name('records');
});





/*
|--------------------------------------------------------------------------
| Organizations Tab
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function(){
    Route::get('organization', [OrganizationController::class, 'index'])->name('organization.index');
    Route::get('organization/{id}', [OrganizationController::class, 'show'])->name('organization.show');
});
Route::group(['middleware' => ['auth', 'isModerator']], function(){
    Route::get('organization/{id}/add', [OrganizationController::class, 'add'])->name('organization.add');
    Route::post('organization/{id}/add/store', [OrganizationController::class, 'store'])->name('organization.store');
    Route::get('organization/{id}/edit/{member}', [OrganizationController::class, 'select'])->name('organization.select');
    Route::put('organization/{id}/edit/{member}/update', [OrganizationController::class, 'update'])->name('organization.update');
    Route::delete('organization/{id}/edit/{member}/remove', [OrganizationController::class, 'destroy'])->name('organization.destroy');
});







/*
|--------------------------------------------------------------------------
| Forms Tab
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'isStudent']], function(){
        // APF
        Route::get('forms/activity-proposal-form', [APFController::class, 'index'])->name('forms.activity-proposal.index');
        Route::post('forms/activity-proposal-form/create', [APFController::class, 'store'])->name('forms.activity-proposal.store');
        // RF
        Route::get('forms/budget-requisition-form', [RFController::class, 'index'])->name('forms.requisition.index');
        Route::post('forms/budget-requisition-form', [RFController::class, 'store'])->name('forms.requisition.store');
        // NR
        Route::get('forms/narrative-report', [NRController::class, 'index'])->name('forms.narrative.index');
        // LF   
        Route::get('forms/liquidation-form', [LFController::class, 'index'])->name('forms.liquidation.index');
        Route::post('forms/liquidation-form/create', [LFController::class, 'store'])->name('forms.liquidation.store');
});







//Below Are Test Route only
Route::post('/test', function(Request $request){
    dd($request);
})->name('test');

Route::get('/test-details', function(){
    return view('_approvers.view-details.liquidation');
})->name('test-details');

Route::get('/test-edit', function(){
    return view('_student-organization.edit-forms.activity-proposal');
});

//Email

//Submitted Forms
Route::get('/apf', function (){
    return new apfSubmittedEmail();
});

Route::get('/rf', function (){
    return new rfSubmittedEmail();
});

Route::get('/nr', function (){
    return new nrSubmittedEmail();
});

Route::get('/lf', function (){
    return new lfSubmittedEmail();
});

Route::get('/org', function (){
    return new OrgMemAddEmail();
});
