<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AssignRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  {
        // $roles = DB::table('users')
        // ->join('organization_user', 'users.id', '=','organization_user.user_id')
        // ->join('organizations', 'organizations.id', '=', 'organization_user.organization_id')
        // ->join('role_user', 'users.id', '=','role_user.user_id')
        // ->join('roles', 'roles.id', '=', 'role_user.role_id')
        // ->select( 'users.id as uid','users.firstName as fname', 'users.lastName as lname', 'organizations.id as orgid', 'organizations.orgName as orgname', 'role_user.user_id as r_uid', 'role_user.role_id as r_rid')
        // ->get();

       
        

       
        
        
        $organizations = Organization::with('studentOrg')->first();
        // $currOrg =  Organization::with('studentOrg')->pluck('id');

        dd($organizations);

      


        // $currUser = auth()->id();


        // dd($currUser);


        $orgMembers = User::with('studentOrg')->get();
        // dd($orgMembers);
        

        // dd(Organization::with('users')->get());

        // dd(User::find()->studentOrg()->get('name'));

        // ->select('users.lastName as lastName', 'organizations.orgName as orgName')

        return view('_student-organization.roles', compact('organizations', 'orgMembers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique',
            'position' => 'required|max:30',
            'role' => 'required'
        ]);

        // DB::table('organization_user')->dba_insert([

        // ])




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
