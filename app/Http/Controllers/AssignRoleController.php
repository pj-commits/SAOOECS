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

        $user = Auth::user();
        // dd($user);
        // $roles = $user->getRoles();

        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();

        $orgMembers = $currOrg->studentOrg;


     
        return view('_student-organization.roles', compact('currOrg', 'orgMembers'));

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
