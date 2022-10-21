<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Event;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        /********************************** 
        * 
        *  For different users
        * 
        **********************************/
       






        if(Auth::user()->checkUserType('Professor|Staff')){
            // Check if the current user is AcadServ or Finance via department_id in Staff table
           $departmentName = DB::table('departments')->find(auth()->user()->userStaff->first()->department_id, 'name');
           if($departmentName === 'Student Activities Office' || 'Finance Office'){
                $isAcadservOrFinance = true;
           }
           $isAcadservOrFinance = false ;

           // forms
           $forms = json_encode(Form::where('status', 'Pending')->get());



            return view('_approvers.dashboard', compact('forms', 'isAcadservOrFinance'));

                
        }else{
            /**************************************************
            *  Fetch form with event id na org id == myorglist
            ***************************************************/
            $authOrgList = Auth::user()->studentOrg->pluck('id')->toArray();
            $myForms = Form::whereIn('organization_id', $authOrgList)->get();

            return view('_student-organization.dashboard', compact('myForms'));
        }
       

    }
}
