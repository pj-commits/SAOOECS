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
        $invite = false;
       

        return view('_student-organization.roles', compact('currOrg', 'orgMembers', 'invite'));

    }

    public function invite()
    {
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = true;

        return view('_student-organization.roles', compact('currOrg', 'orgMembers','invite'));
    }

    public function store(Request $request)
    {
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = true;
        
        //fetch from dummy user api
        $response = json_decode(Http::get('https://sample-user-api.herokuapp.com/users'));

        //Get key. if user is not in api = error
        $key = array_search($request->email, array_column($response, 'email'));
        
        // valitdate request
        $formFields = $request->validate([ 
            'email' =>  
                'required',
                'email',
                // function($attribute, $value, $fail){
                //     $key = array_search($request->email, array_column($response, 'email'));
                //     if($key === false){
                //         $fail("This user doesn't exist on our api. Please use email registered already in api.");
                //     }
                // },
            'position' => 'required|max:30',
            'role' => 'required'  
        ]);

        //create/store fetched
        $getUser = $response[$key];
        $user = User::create([
            'firstName' => $getUser->firstName,
            'middleName' => $getUser->middleName,
            'lastName' => $getUser->lastName,
            'phoneNumber' => $getUser->phoneNumber,
            'email' => $getUser->email,
            'password' => bcrypt($getUser->password)
        ]);

        //attach role, org, position to fetched
        $user->attachRole($request->role_id);
        $user->studentOrg()->attach($currOrgId, ['position' => $request->position]);

        //Register the fetched. This will send verification email. Customize the email under resources/views/vendor
        event(new Registered($user));
       
        return view('_student-organization.roles', compact('currOrg', 'orgMembers','invite'));
    }

    public function edit($member)
    {
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = true;
        
        $selected = User::findorfail($member);
        

        return view('_student-organization.roles', compact('currOrg', 'orgMembers','invite', 'selected'));
    }

    public function update(Request $request, $member)
    {
      
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = true;

        $selected = User::findorfail($member);

        // valitdate request
        $formFields = $request->validate([ 
            'position' => 'required|max:30',
            'role' => 'required'  
        ]);
        // dd($selected->firstName);
        // dd($selected->studentOrg->first()->pivot->position);
        // dd($selected->role->first()->id);

        $formFields = User::update([
            'position' => $getUser->middleName,
            'role' => $getUser->lastName,
        ]);

        return view('_student-organization.roles', compact('currOrg', 'orgMembers','invite', 'selected'));

    }

   

    public function destroy($id)
    {
        //
    }
}
