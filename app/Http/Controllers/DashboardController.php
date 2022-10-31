<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Event;
use App\Models\Department;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){

        /********************************** 
        * 
        *  For different users
        * 
        **********************************/
        //checks if user is a professor and have an org or if user is a staff
        if((Auth::user()->checkUserType('Professor') && Auth::user()->isOrgMember()) || Auth::user()->checkUserType('Staff')){
            if(Helper::userExistsInStaff()){
                // Check if the current user is AcadServ or Finance via department_id in Staff table
                $departmentName = DB::table('departments')->find(auth()->user()->userStaff->first()->department_id, 'name');

                if($departmentName === 'Student Activities Office' || 'Finance Office'){

                        $isAcadservOrFinance = true;

                }
                $isAcadservOrFinance = false ;

                // Getting the forms and destructuring it.
                $getForms = Form::where('status', 'Pending')->get();
                $forms = [];
                foreach($getForms as $form){
                        array_push($forms, [
                            'id' => Helper::encrypt($form->id),
                            'organization' => $form->myOrg->getOrgName->org_name,
                            'event_title' => $form->event_title,
                            'form_type' => $form->form_type,
                            'deadline' => $form->deadline,
                        ]);
                }

                    return view('_approvers.dashboard', compact('forms', 'isAcadservOrFinance'));
            }
            return view('_users.dashboard');

                
        }elseif(Auth::user()->checkUserType('Student')){

            /**************************************************
            *  Fetch form with event id na org id == myorglist
            ***************************************************/
            $authOrgList = Auth::user()->studentOrg->pluck('id')->toArray();
            // $myForms = Form::whereIn('organization_id', $authOrgList)->get();

            $myForms = Form::whereIn('organization_id', $authOrgList)
            ->where(function ($query) {
                $query->where('status','Pending')->orWhere('status', 'Denied');
            })->orderBy('created_at', 'desc')->get();


            return view('_student-organization.dashboard', compact('myForms'));
        }
        return view('_users.dashboard');
    }
       

    public function cancel(Request $request)
    {
        $form = Form::findOrFail($request->formId);
        $eventTitle = $form->event_title;
        
        if($eventTitle === $request->checker){
            $form->status = "Cancelled";
            $form->update();

            $message = $request->checker. " was succesfully cancelled!";

            return redirect()->back()->with('remove', $message);
        }
        
        return redirect()->back()->with('error', 'Do not try it again! This action is recorded.');
    }

}
