<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RFController;
use App\Http\Controllers\APFController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssignRoleController;
use App\Mail\apfSubmittedEmail;
use App\Mail\rfSubmittedEmail;
use App\Mail\nrSubmittedEmail;
use App\Mail\lfSubmittedEmail;
use App\Mail\ForwardFormNextApproverEmail;
use App\Mail\AddOrganizationMemberEmail;
use App\Mail\EditOrganizationMemberEmail;
use App\Mail\RemoveOrganizationMemberEmail;
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
Route::get('/',  [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');


// ROLE TAB: Role managers/moderators == adviser, pres, sao
Route::group(['middleware'=> ['auth', 'role:moderator|editor|viewer']], function(){
    Route::get('roles', [AssignRoleController::class, 'index'])->name('roles.index');
});
Route::group(['middleware'=> ['auth', 'role:moderator']], function(){
    // Add member
    Route::get('roles/invite', [AssignRoleController::class, 'invite'])->name('roles.invite');
    Route::post('roles', [AssignRoleController::class, 'store'])->name('roles.store');
    //Edit Member
    Route::get('roles/{member}/edit', [AssignRoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{member}', [AssignRoleController::class, 'update'])->name('roles.update');
    //Delete Member
    Route::get('roles/{member}/del', [AssignRoleController::class, 'del'])->name('roles.del');
    Route::delete('roles/del/{member}', [AssignRoleController::class, 'destroy'])->name('roles.destroy');
});

// FORMS TAB: moderator and editor: 
//  -- index, store, show, approve, deny, track, calendar
Route::group(['middleware'=>['auth', 'role:moderator|editor']], function(){
    // APF
    Route::get('forms/activity-proposal-form', [APFController::class, 'index'])->name('forms.apf.index');
    Route::post('forms/activity-proposal-form', [APFController::class, 'store'])->name('forms.apf.store');

    // RF
    Route::get('forms/budget-requisition-form', [RFController::class, 'index'])->name('forms.rf.index');
    Route::post('forms/budget-requisition-form', [RFController::class, 'store'])->name('forms.rf.store');

    // NR

    // LF

});





//Remove this when functions for records tab will be put under development.
Route::get('records', [RecordsController::class, 'index'])->name('records');


//Below Are Test Route only
Route::get('submitted-forms', function (){
    return view('_approvers.submitted-forms')
        ->with("message", "Hello Submitted Forms!");
})->name('submitted-forms');



Route::get('forms/narrative-report', function (){
    return view('_student-organization.forms.narrative')
        ->with("message", "Hello NR!");
})->name('narrative');

Route::get('forms/liquidation-form', function (){
    return view('_student-organization.forms.liquidation')
        ->with("message", "Hello LF!");
})->name('liquidation');


Route::post('/test', function(Request $request){
    dd($request);
})->name('test');

Route::get('/test-details', function(){
    return view('_approvers.view-details.liquidation');
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

//ForwardFormNextApproverEmail 
Route::get('/forward', function (){
    return new ForwardFormNextApproverEmail();
});

//Add Member in Organization
Route::get('/orgadd', function (){
    return new AddOrganizationMemberEmail();
});

//Edit Member in Organization
Route::get('/orgedit', function (){
    return new EditOrganizationMemberEmail();
});

//Remove Member in Organization
Route::get('/orgremove', function (){
    return new RemoveOrganizationMemberEmail();
});
