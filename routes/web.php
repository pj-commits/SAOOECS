<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LFController;
use App\Http\Controllers\RFController;
use App\Http\Controllers\APFController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\NRController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SubmittedFormsController;
use App\Mail\apfSubmittedEmail;
use App\Mail\rfSubmittedEmail;
use App\Mail\nrSubmittedEmail;
use App\Mail\lfSubmittedEmail;
use App\Mail\OrgMemAddEmail;
use App\Http\Controllers\DepartmentHeadController;

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

        // Denied show for edit
        Route::get('forms/details/{forms}/edit', [DashboardController::class, 'show'])->name('forms.edit.show');
        // APF
        Route::get('forms/activity-proposal-form', [APFController::class, 'index'])->name('forms.activity-proposal.index');
        Route::post('forms/activity-proposal-form/create', [APFController::class, 'store'])->name('forms.activity-proposal.store');
        Route::put('forms/activity-proposal-form/{forms}', [APFController::class, 'update'])->name('forms.activity-proposal.update');
        // RF
        Route::get('forms/budget-requisition-form', [RFController::class, 'index'])->name('forms.requisition.index');
        Route::post('forms/budget-requisition-form/create', [RFController::class, 'store'])->name('forms.requisition.store');
        Route::put('forms/budget-requisition-form/{forms}', [RFController::class, 'update'])->name('forms.requisition.update');
        // NR
        Route::get('forms/narrative-report', [NRController::class, 'index'])->name('forms.narrative.index');
        Route::post('forms/narrative-report/create', [NRController::class, 'store'])->name('forms.narrative.store');
        Route::put('forms/narrative-report/{forms}', [NRController::class, 'update'])->name('forms.narrative.update');
        // LF   
        Route::get('forms/liquidation-form', [LFController::class, 'index'])->name('forms.liquidation.index');
        Route::post('forms/liquidation-form/create', [LFController::class, 'store'])->name('forms.liquidation.store');
        Route::put('forms/liquidation-form/{forms}', [LFController::class, 'update'])->name('forms.liquidation.update');

});


/*
|--------------------------------------------------------------------------
| Submitted forms review details
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function(){
        Route::get('/submitted-forms', [SubmittedFormsController::class, 'index'])->middleware('isApprover')->name('submitted-forms.index');
        Route::get('/submitted-forms/details/{forms}', [SubmittedFormsController::class, 'show'])->name('submitted-forms.show');
        Route::put('/submitted-forms/details/{forms}/approve', [SubmittedFormsController::class, 'approve'])->middleware('isApprover')->name('submitted-forms.approve');
        Route::put('/submitted-forms/details/{forms}/deny', [SubmittedFormsController::class, 'deny'])->middleware('isApprover')->name('submitted-forms.deny');


});



/*
|--------------------------------------------------------------------------
| Departments && Applications Tab
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'isSaoHead']], function(){
    Route::get('/departments', [DepartmentHeadController::class, 'index'])->name('department-heads.index');
    Route::get('/departments/{departmentId}/replace/{userId}', [DepartmentHeadController::class, 'edit'])->name('department-heads.edit');
    Route::put('/departments/{departmentId}/replace/{userId}/update', [DepartmentHeadController::class, 'update'])->name('department-heads.update');

    Route::get('/org-application', [ApplicationController::class, 'index'])->name('org-application.index');
    Route::get('/org-application/{id}', [ApplicationController::class, 'show'])->name('org-application.show');
    Route::put('/org-application/{id}/approve', [ApplicationController::class, 'approve'])->name('org-application.approve');
    Route::put('/org-application/{id}/deny', [ApplicationController::class, 'deny'])->name('org-application.deny');
    Route::post('/org-application/create', [ApplicationController::class, 'create'])->name('org-application.create');
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
