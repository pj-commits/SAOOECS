<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecordsController extends Controller
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
        
        $approvedAndCancelled = Form::where('status', '=', 'Approved')
            ->orWhere('status', '=', 'Cancelled')
            ->where(function ($query) {
                $user = auth()->user();

                // LIST: id of orgs curr user belongs to
                $getAuthOrgIdList = $user->studentOrg->pluck('id');

                // LIST: orgUserId of curr user
                $getAuthOrgUserIdList = $user->checkOrgUser->pluck('id');

                
                if($user->checkUserType('Professor|Staff')){
                    $staff = $user->userStaff;
                    $isHead = $staff->position === 'Head';
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
                }elseif($user->checkUserType('Student')){
                    $query->whereIn('organization_id', $getAuthOrgIdList); 
                }   
                
                
            })
           ->paginate(10);

        return view('_users.records', compact('approvedAndCancelled'));
    }
}
