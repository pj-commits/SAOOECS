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
        /*********************************************************
        *  Fetch pending forms with current user part of approvers
        **********************************************************/
        
        $pendingForms = Form::where('status', '=', 'Pending')
            ->where(function ($query) {
                $staffId = auth()->user()->userStaff->where('user_id',auth()->user()->id)->pluck('id')->first();
                $department = DB::table('departments')->find(auth()->user()->userStaff->first()->department_id);
                $isHead= auth()->user()->userStaff->position === 'Head';
                $isAdviser = auth()->user()->studentOrg->first()->pivot->position === 'Adviser';

                if($department->name === 'Student Activities Office' && $isHead){
                    $departmentCode = 'sao' ;
                }elseif($department === 'Academic Services'&& $isHead){
                    $departmentCode = 'acadserv' ;
                }elseif($department === 'Finance Office' && $isHead){
                    $departmentCode = 'finance' ;
                }else{
                $departmentCode = 'adviser' ;
                }

                $query->where($departmentCode.'_staff_id', $staffId);
                $query->where($departmentCode.'_is_approve', 0);
            })->get();
            dd($pendingForms);
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
