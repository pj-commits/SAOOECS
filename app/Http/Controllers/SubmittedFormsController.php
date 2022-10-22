<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Staff;
use App\Models\Proposal;
use App\Models\Liquidation;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmittedFormsController extends Controller
{
 
    public function index()
    {
        /****************************************************************
        *  Fetch forms: 
        *  1. must be pending
        *  2. must have forms.curr_approver = current user's dept/name + isHead 
        *  (defines the forms place in process)
        *  3. for advisers, forms of his orgs
        *****************************************************************/
        
        $pendingForms = Form::where('status', '=', 'Pending')
            ->where(function ($query) {
                $user = auth()->user();
                $staff = $user->userStaff;
                $isHead = $staff->position === 'Head';
                $getAuthOrgIdList = $user->studentOrg->pluck('id');
                $department = DB::table('departments')->find($staff->department_id);


                if($department->name === 'Student Activities Office' && $isHead ){
                    $query->where('curr_approver', 'SAO');
                }elseif($department->name === 'Academic Services' && $isHead){
                    $query->where('curr_approver', 'Academic Services');
                }elseif($department->name === 'Finance Office'  && $isHead){
                    $query->where('curr_approver', 'Finance');      
                }
                if($user->checkPosition('Adviser')){
                    $query->orwhereIn('organization_id', $getAuthOrgIdList);
                    $query->orwhere('curr_approver', 'Adviser');
                }
                    
            })
           ->paginate(10);


        

        //    dd($pendingForms);



        return view('_approvers.submitted-forms', compact('pendingForms'));
    }

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

            // dd($liquidation, $proofOfPayments, $liquidationItems);


            return view('_approvers.view-details.liquidation',  compact('forms', 'liquidation', 'proofOfPayments', 'liquidationItems' )  );

        }elseif($forms->form_type === 'NR'){

        $narrative = Narrative::where('form_id', $forms->id)->firstOrFail();

        $participants = $narrative->participant;
        $postPrograms = $narrative->postProgram;
        $narrativeImages = $narrative->narrativeImage;
        $commentSuggestions = $narrative->commentSuggestion;


        // $participants = $narrative->reqItems;

        return view('_approvers.view-details.narrative', compact('forms', 'narrative', 'participants', 'postPrograms', 'narrativeImages', 'commentSuggestions' )  );

        }

        return abort('404');

        


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
