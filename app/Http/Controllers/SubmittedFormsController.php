<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmittedFormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /****************************************************************
        *  Fetch forms: 
        *  1. must be pending
        *  2. must have curr_approver = current user's dept/name + isHead 
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

            // $query->where('adviser_staff_id', $staff->id);
            // $query->orWhere('acadserv_staff_id', $staff->id);
            // $query->orWhere('sao_staff_id', $staff->id);
            // $query->orWhere('finance_staff_id', $staff->id);

                if($department->name === 'Student Activities Office' && $isHead ){
                    $query->where('curr_approver', 'SAO');
                }elseif($department->name === 'Academic Services' && $isHead){
                    $query->where('curr_approver', 'Academic Services');
                }elseif($department->name === 'Finance Office'  && $isHead){
                    $query->where('curr_approver', 'Finance');
                }else{
                    $query->where('curr_approver', 'Adviser');
                    $query->whereIn('organization_id', $getAuthOrgIdList);
                }  
            })
           ->paginate(10);


        return view('_approvers.submitted-forms', compact('pendingForms'));
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
    public function show($id)
    {
        //
    }

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
