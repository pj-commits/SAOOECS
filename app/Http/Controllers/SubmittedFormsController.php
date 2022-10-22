<?php

namespace App\Http\Controllers;

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

                // LIST: id of orgs curr user belongs to
                $getAuthOrgIdList = $user->studentOrg->pluck('id');

                // LIST: orgUserId of curr user
                $getAuthOrgUserIdList = $user->checkOrgUser->pluck('id');

                $department = DB::table('departments')->find($staff->department_id);

                if($user->checkPosition('Adviser')){                            //  are you an adviser of an org?
                    $query->whereIn('adviser_staff_id', $getAuthOrgUserIdList );//  form curr adviser_staff_id == your orgUser Id ?
                    $query->whereIn('organization_id', $getAuthOrgIdList);      //  form is part of curr user's org ? 
                    $query->where('curr_approver', 'Adviser');                  //  form curr_approver == adviser ?
                }

                if($department->name === 'Student Activities Office' && $isHead ){
                    $query->where('sao_staff_id', $staff->id);
                    $query->where('curr_approver', 'SAO');
                }
                
                if($department->name === 'Academic Services' && $isHead){
                    $query->where('acadserv_staff_id', $staff->id);
                    $query->where('curr_approver', 'Academic Services');
                }
                
                if($department->name === 'Finance Office'  && $isHead){
                    $query->where('finance_staff_id', $staff->id);
                    $query->where('curr_approver', 'Finance');      
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

    /******************************************************************
    *  
    *   Approve
    *
    ********************************************************************/

    public function approve(Form $forms)
    {

        $forms->update(array('status' => 'Approved'));

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
