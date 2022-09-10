<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AssignRoleController extends Controller
{
    public function index()  
    {
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
     
        return view('_student-organization.roles', compact('currOrg', 'orgMembers'));

    }

    public function invite(Request $request)
    {
       
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
       
        $formFields = $request->validate([
            'email' =>  ['required','email', Rule::unique('users', 'email')],
            'position' => 'required|max:30',
            'role' => 'required'
        ]);

        dd($formFields);
        

        Mail::to($formFields->email)->send(new InviteEmail($formFields,  $currOrg));
       
        return redirect('_student-organization.roles');
    
        




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
