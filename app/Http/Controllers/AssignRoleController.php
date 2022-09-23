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


        return view('_student-organization.roles', compact('currOrg', 'orgMembers', 'invite'));
    }

    public function store(Request $request)
    {
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = false;
        
        //fetch from dummy user api
        //Get key. if user is not in api = error
        $response = json_decode(Http::get('https://sample-user-api.herokuapp.com/users'));
        $key = array_search($request->email, array_column($response, 'email'));

        // // valitdate request
        $formFields = $request->validate([ 
            'email' =>  [
                'required',
                'email',
                Rule::unique('users','email'),
                
                function($attribute, $value, $fail){
                    $response = json_decode(Http::get('https://sample-user-api.herokuapp.com/users'));
                    $key = array_search($value, array_column($response, 'email'));  

                    if($key === false){
                        $fail("User not found. Please use valid APC Email!");
                    }
                }],
            'position' => 'required|regex:/^[a-zA-Z]+$/u|max:30',
            'role_id' => 'required'  
            ], 
            [
            'role_id.required' => 'Role field is required'
            ]
        );

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

        //capitalized first letter of position
        $position = ucfirst($request->position);


        //attach role, org, position to fetched
        $user->attachRole($request->role_id);
        $user->studentOrg()->attach($currOrgId, ['position' => $position]);

        //Register the fetched. This will send verification email. Customize the email under resources/views/vendor
        // event(new Registered($user));

        $message = $user->firstName.' '. $user->lastName.' was successfully assigned as '. $position.'!';
       
        return redirect()->route('roles.index', compact('currOrg', 'orgMembers', 'invite'))->with('add', $message);
    }

    public function edit($member)
    {
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = false;
        $del = false;
        
        $selected = User::findorfail($member);
    
        return view('_student-organization.roles', compact('currOrg', 'orgMembers', 'invite', 'selected'));
    }

    public function update(Request $request, $member)
    {
      
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = true;

        $selected = User::findorfail($member);

        // $member = $selected->id;
        // dd($selected->role->first()->id);

        $formFields = $request->validate([
            'position' => 'required|max:30',
            'role_id' => 'required' 
        ]);

        //capitalized first letter of position
        $position = ucfirst($request->position);
        
        $selected->studentOrg()->update(['position' => $position]);

        $selected->role->first()->pivot->role_id = $request->role_id; 
        $selected->role->first()->pivot->update();

        $message = $selected->firstName.' '.$selected->lastName.' was succesfully edited!';

        return redirect()->route('roles.index', compact('currOrg', 'orgMembers','invite', 'selected'))->with('edit', $message);
    }

    public function del($member)
    {
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = false;
        $del = true;

        $selected = User::findorfail($member);
    
        return view('_student-organization.roles', compact('currOrg', 'orgMembers', 'invite','selected', 'del'));
    }

   

    public function destroy($member)
    {
       
        $currUserId = auth()->id();
        $currOrgId = DB::table('organization_user')->where('user_id', '=', $currUserId)->pluck('organization_id')->first();
        $currOrg = Organization::with('studentOrg')->where('id', '=', $currOrgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = false;
        $del = true;

        $selected = User::findorfail($member);

        User::where('id', $member)->delete();

        $message = $selected->firstName.' '.$selected->lastName.' was successfully removed from the organization.';
        
        return redirect()->route('roles.index', compact('currOrg', 'orgMembers','invite', 'selected','del'))->with('remove', $message);
    }
}
