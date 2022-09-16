<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\InviteMail;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

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
        $currOrgName = $currOrg->orgName;
        
        //valitdate request
        // $formFields = $request->validate([ 
        //     'email' =>  'required','email', Rule::unique('users', 'email'),
        //     'position' => 'required|max:30',
        //     'role' => 'required'  
        // ]);
        // dd($validatedData);

        //fetch from dummy user api
        $response = json_decode(Http::get('https://sample-user-api.herokuapp.com/users'));

        //Get key. if user is not in api = error
        $key = array_search($request->email, array_column($response, 'email'));
        if($key === False){
            dd("This user doesn't exist on our api. Please use email registered already in api.");
        }

        //create/store user data
        $getUser = $response[$key];
        $user = User::create([
            'firstName' => $getUser->firstName,
            'middleName' => $getUser->middleName,
            'lastName' => $getUser->lastName,
            'phoneNumber' => $getUser->phoneNumber,
            'email' => $getUser->email,
            'password' => bcrypt($getUser->password)
        ]);
        //attach role, org, position
        $user->attachRole($request->role_id);
        $user->studentOrg()->attach($currOrgId, ['position' => $request->position]);
        // $user->studentOrg()->attach($request->position);

        //Register the fetch. This will send verification emaiL
        event(new Registered($user));

        //email (not needed)
        // Mail::to($request->email)->send(new InviteMail($currOrgName));
       
        return back()->with('message', 'Email invite sent!');
    }

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
