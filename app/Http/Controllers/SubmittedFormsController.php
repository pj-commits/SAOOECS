<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Form;
use App\Models\Staff;
use App\Helper\Helper;
use App\Models\Proposal;
use App\Models\Liquidation;
use App\Models\Requisition;
use App\Models\Narrative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SubmittedFormsController extends Controller
{
 
    public function index(Request $request)
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

        if(Helper::userExistsInStaff()){
            $forms = Form::where('status', '=', 'Pending')
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
                    //  are you an adviser of an org?
                    //  form curr organization_user_adviser_id == your orgUser Id ?
                    //  form is part of curr user's org ? 
                    //  form curr_approver == adviser ?
                    //  form is not yet approved   

                 // dd($isAdviser, $isSaoHead, $isAcadServHead, $isFinanceHead);// -> Uncomment me later!!!         
                
                if($isAdviser === true && $isSaoHead === false && $isAcadServHead === false && $isFinanceHead === false){
                
                    //    dd('test');
                        $query->whereIn('organization_user_adviser_id', $getAuthOrgUserIdList );
                        $query->whereIn('organization_id', $getAuthOrgIdList);
                        $query->where('curr_approver', 'Adviser');                  
                        $query->where('adviser_is_approve', 0);     
                    
                }else{
              
                    if($isSaoHead){
                        $query->where('sao_staff_id', $staff->id);
                        $query->where('curr_approver', 'SAO');
                        $query->where('adviser_is_approve', 1);
                        $query->where('sao_is_approve', 0); 
                        $query->orwhere(function ($query) {
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

                            if($isAdviser){
                                    $query->whereIn('organization_user_adviser_id', $getAuthOrgUserIdList );
                                    $query->whereIn('organization_id', $getAuthOrgIdList);
                                    $query->where('curr_approver', 'Adviser');                  
                                    $query->where('adviser_is_approve', 0);     
                                }   
                        });
                    }                                                
                    if($isAcadServHead){
                        $query->where('acadserv_staff_id', $staff->id);
                        $query->where('curr_approver', 'Academic Services');
                        $query->where('sao_is_approve', 1);
                        $query->where('acadserv_is_approve', 0); 
                        $query->orwhere(function ($query) {
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

                            if($isAdviser){
                                    $query->whereIn('organization_user_adviser_id', $getAuthOrgUserIdList );
                                    $query->whereIn('organization_id', $getAuthOrgIdList);
                                    $query->where('curr_approver', 'Adviser');                  
                                    $query->where('adviser_is_approve', 0);     
                                }   
                        });   
                    }          
                    if($isFinanceHead){
                        $query->where('finance_staff_id', $staff->id);
                        $query->where('curr_approver', 'Finance');
                        $query->where('acadserv_is_approve', 1);
                        $query->where('finance_is_approve', 0);   
                        $query->orwhere(function ($query) {
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

                            if($isAdviser){
                                    $query->whereIn('organization_user_adviser_id', $getAuthOrgUserIdList );
                                    $query->whereIn('organization_id', $getAuthOrgIdList);
                                    $query->where('curr_approver', 'Adviser');                  
                                    $query->where('adviser_is_approve', 0);     
                                }   
                        });        
                    }
                }
            })->paginate();

            // dd($isAdviser, $isSaoHead, $isAcadServHead, $isFinanceHead);// -> Uncomment me later!!!       

            $pendingForms = [];
            
            foreach($forms as $form){
                array_push($pendingForms, [
                    'id' => Helper::encrypt($form->id),
                    'formType' => $form->form_type,
                    'eventTitle' => $form->event_title,
                    'date' => Carbon::parse($form->created_at)->format('F d, Y - h:i A'),
                    'organization' => $form->myOrg->getOrgName->org_name,
                ]);
            }

            return view('_approvers.submitted-forms', compact('pendingForms'));
        }
        abort(403);
    }

    /******************************************************************
    *  
    *   View form for approval
    *
    ********************************************************************/

    public function show($id)
    {   
        $formId = Helper::decrypt($id);

        $forms = Form::findOrFail($formId);

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
        $getAuthOrgUserIdList = $user->checkOrgUser->pluck('id');


        $department = DB::table('departments')->find($staff->department_id);

        $isAdviser = $user->isAdviser('Adviser', $forms->organization_id);
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
