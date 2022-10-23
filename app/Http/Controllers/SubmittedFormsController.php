<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Form;
use App\Models\Staff;
use App\Models\Proposal;
use App\Models\Liquidation;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SubmittedFormsController extends Controller
{
 
    public function index()
    {
        /******************************************************************
        *  Fetch forms: 
        *  1. must be pending
        *  2. must have forms.curr_approver = current user's dept/name + isHead 
        *  (defines the forms place in process)
        *  3. must have its staff_id == (approver)_staff_id // org = orgUser ID
        *   
        *       Forms ----> Staff and OrgUser, thats where we will check 
        *       the id on forms 
        *   
        ********************************************************************/
        
        $pendingForms = Form::where('status', '=', 'Pending')
            ->where(function ($query) {
                $user = auth()->user();
                $staff = $user->userStaff;
                $isHead = $staff->position === 'Head';
                $department = DB::table('departments')->find($staff->department_id);

                // APPROVER TYPE: Check if true or false
                $isAdviser = $user->checkPosition('Adviser');
                $isSaoHead = $department->name === 'Student Activities Office' && $isHead;
                $isAcadServHead = $department->name === 'Academic Services' && $isHead;
                $isFinanceHead = $department->name === 'Finance Office'  && $isHead;

                // LIST: id of curr user belongs to
                $getAuthOrgIdList = $user->studentOrg->pluck('id');

                // LIST: orgUserId of curr user
                $getAuthOrgUserIdList = $user->checkOrgUser->pluck('id');


                // Display ADVISER to-be-approved forms

                if($user->checkPosition('Adviser')){     
                                           //  are you an adviser of an org?
                    $query->whereIn('adviser_staff_id', $getAuthOrgUserIdList );//  form curr adviser_staff_id == your orgUser Id ?
                    $query->whereIn('organization_id', $getAuthOrgIdList);      //  form is part of curr user's org ? 
                    $query->where('curr_approver', 'Adviser');                  //  form curr_approver == adviser ?
                    $query->where('adviser_is_approve', 0);                     //  form is not yet approved

                }

                // Display SAO to-be-approved forms

                if($department->name === 'Student Activities Office' && $isHead ){
                    $query->where('sao_staff_id', $staff->id);
                    $query->where('curr_approver', 'SAO');
                    $query->where('adviser_is_approve', 1);
                    $query->where('sao_is_approve', 0);                     //  form is not yet approved

                }

                // Display ACADEMIC SERVICES to-be-approved forms
                
                if($department->name === 'Academic Services' && $isHead){
                    $query->where('acadserv_staff_id', $staff->id);
                    $query->where('curr_approver', 'Academic Services');
                    $query->where('sao_is_approve', 1);
                    $query->where('acadserv_is_approve', 0);                     //  form is not yet approved

                }

                // Display FINANCE to-be-approved forms

                if($department->name === 'Finance Office'  && $isHead){
                    $query->where('finance_staff_id', $staff->id);
                    $query->where('curr_approver', 'Finance');
                    $query->where('acadserv_is_approve', 1);
                    $query->where('finance_is_approve', 0);                     //  form is not yet approved


                }
                
            })
           ->paginate(10);


        return view('_approvers.submitted-forms', compact('pendingForms'));
    }

    /******************************************************************
    *  
    *   View form for approval
    *
    ********************************************************************/

    public function show(Form $forms)
    {   
        if($forms->form_type === 'APF'){

            $proposal = Proposal::where('form_id', $forms->id)->firstOrFail();

            $externalCoorganizers = $proposal->externalCoorganizer;
            $logisticalNeeds = $proposal->logisticalNeed;
            $prePrograms = $proposal->preprograms;

            return view('_approvers.view-details.activity-proposal', compact('forms', 'proposal', 'externalCoorganizers', 'logisticalNeeds', 'prePrograms' )  );

        }elseif($forms->form_type === 'BRF'){

            $requisition = Requisition::where('form_id', $forms->id)->firstOrFail();
            
            $requisitionItems = $requisition->reqItems;

            return view('_approvers.view-details.budget-requisition',  compact('forms', 'requisition', 'requisitionItems')  );
        
        }elseif($forms->form_type === 'LF'){

            $liquidation = Liquidation::where('form_id', $forms->id)->firstOrFail();

            $proofOfPayments = $liquidation->proofOfPayment;
            $liquidationItems = $liquidation->liquidationItem;

            return view('_approvers.view-details.liquidation',  compact('forms', 'liquidation', 'proofOfPayments', 'liquidationItems' )  );

        }elseif($forms->form_type === 'NR'){

            $narrative = Narrative::where('form_id', $forms->id)->firstOrFail();

            $participants = $narrative->participant;
            $postPrograms = $narrative->postProgram;
            $narrativeImages = $narrative->narrativeImage;
            $commentSuggestions = $narrative->commentSuggestion;

        return view('_approvers.view-details.narrative', compact('forms', 'narrative', 'participants', 'postPrograms', 'narrativeImages', 'commentSuggestions' )  );

        }
        
        return abort('404');

    }

    /********************************************************************************
    *  
    *     APPROVE
    *    1. If (adviser) AND (other approver), auto approve those roles
    *    2. If normal == normal process
    *    3. If form is_approve = 1 , skip that one (means, the form is returned to process)
    *    4. Change current approver every time = to the next
    *    5. Approved if it's on the last stop
    *    6. Process:
    *        APF || RF 	== 1, 2, 3, 4
    *        LF 		== 1, 4
    *        NR 		== 1, 2
    *
    *     ___________________________________________________________
    *    ||  1 = adv      2 = sao     3 = acadserv    4 = finance   ||
    *    ||_________________________________________________________||
    *
    ********************************************************************************/

    public function approve(Form $forms)
    {   
        // Declarations
        $user = auth()->user();
        $staff = $user->userStaff;
        $isHead = $staff->position === 'Head';

        $department = DB::table('departments')->find($staff->department_id);

        $isAdviser = $user->checkPosition('Adviser');
        $isSaoHead = $department->name === 'Student Activities Office' && $isHead;
        $isAcadServHead = $department->name === 'Academic Services' && $isHead;
        $isFinanceHead = $department->name === 'Finance Office'  && $isHead;

        $now = Carbon::now()->setTimezone('Asia/Manila');
        $deadline = Carbon::now()->setTimezone('Asia/Manila')->addDays(3);
        $adviser = 'Adviser';
        $sao = 'SAO';
        $acadserv = 'Academic Services';
        $finance = 'Finance';
        $yes = 1;
        $no = 0;
        $done = 'Done';
        $approved = 'Approved';


        // dd($now, $deadline )

        // For Narrative = (1 -> 2)
        if($forms->form_type == 'NR' ){

            if($isAdviser){

                if($forms->adviser_is_approve === 0 ){
                    $forms->update(array(
                        'adviser_is_approve' => $yes,
                        'adviser_date_approved' => $now,
                        'deadline' => $deadline,
                        'curr_approver' => $sao
                    ));
                }
            }

            if($isSaoHead){
                if($forms->sao_is_approve === 0 ){
                    $forms->update(array(
                        'sao_is_approve' => $yes,
                        'sao_date_approved' => $now,
                        'deadline' => $deadline,
                        'curr_approver' => $done,
                        'status' => $approved

                    ));
                }
            }
        }

        // For Liquidation (1 -> 4)
        if($forms->form_type == 'LF' ){

            if($isAdviser){
                if($forms->adviser_is_approve === 0 ){
                    $forms->update(array(
                        'adviser_is_approve' => $yes,
                        'acadserv_is_approve' => $yes,
                        'adviser_date_approved' => $now,
                        'deadline' => $deadline,
                        'curr_approver' => $finance
                    ));
                }
            }

            if($isFinanceHead){
                if($forms->finance_is_approve === 0 ){
                    $forms->update(array(
                        'finance_is_approve' => $yes,
                        'finance_date_approved' => $now,
                        'deadline' => $deadline,
                        'curr_approver' => $done,
                        'status' => $approved
                    ));
                }
            }
        }

         // For APF and BRF (1 -> 2 -> 3 -> 4)
         if($forms->form_type == 'APF' || 'BRF' ){

            if($isAdviser){
                if($forms->adviser_is_approve === 0 ){
                    $forms->update(array(
                        'adviser_is_approve' => $yes,
                        'acadserv_is_approve' => $yes,
                        'adviser_date_approved' => $now,
                        'deadline' => $deadline,
                        'curr_approver' => $sao
                    ));
                }
            }

            if($isSaoHead){
                if($forms->sao_is_approve === 0 ){
                    $forms->update(array(
                        'sao_is_approve' => $yes,
                        'sao_date_approved' => $now,
                        'deadline' => $deadline,
                        'curr_approver' => $acadserv,
                    ));
                }
            }

            if($isAcadServHead){
                if($forms->acadserv_is_approve === 0 ){
                    $forms->update(array(
                        'acadserv_is_approve' => $yes,
                        'acadserv_date_approved' => $now,
                        'deadline' => $deadline,
                        'curr_approver' => $finance,
                    ));
                }
            }

            if($isFinanceHead){
                if($forms->finance_is_approve === 0 ){
                    $forms->update(array(
                        'finance_is_approve' => $yes,
                        'finance_date_approved' => $now,
                        'deadline' => $deadline,
                        'curr_approver' => $done,
                        'status' => $approved
                    ));
                }
            }
        }

        $message = $forms->event_title.' was approved!';

        return Redirect::route('submitted-forms.index')->with('add', $message);
    }

    /******************************************************************
    *  
    *   Deny
    *
    ********************************************************************/

    public function deny(Request $request, Form $forms)
    {
        
        $forms->update(array('status' => 'Denied', 'remarks' => $request->remarks));

        $message = $forms->event_title.' was denied!';

        return Redirect::route('submitted-forms.index')->with('remove', $message);
    }

}
