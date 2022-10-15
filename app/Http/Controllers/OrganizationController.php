<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
class OrganizationController extends Controller
{
    public function index()
    {
        $authOrgList = Auth::user()->studentOrg;

        return view('_student-organization.organization-list', compact('authOrgList'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $orgId)
    {
        $currOrg = Organization::with('studentOrg')->where('id', '=', $orgId)->first();
                
        //fetch from dummy user api
        //Get key. if user is not in api = error
        $response = json_decode(Http::get('https://sample-user-api.herokuapp.com/users'));
        $key = array_search($request->email, array_column($response, 'email'));

        // // valitdate request
        $request->validate([ 
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
            'role' => 'required'  
            ], 
            [
            'role.required' => 'Role field is required'
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
            'userType' => 'Student',
            'password' => bcrypt($getUser->password)
        ]);

        //capitalized first letter of position
        $position = ucfirst($request->position);


        //attach role, org, position to fetched
        // $user->attachRole($request->role_id);
        $user->studentOrg()->attach($orgId, ['position' => $position, 'role' => $request->role]);

        //Register the fetched. This will send verification email. Customize the email under resources/views/vendor
        // event(new Registered($user));

        $message = $user->firstName.' '. $user->lastName.' was successfully assigned as '. $position.'!';
       
        // return redirect()->back()->with('add', $message)->with('invite', $invite);
        return Redirect::route('organization.show', ['id'=>$currOrg->id, 'invite' => 'false'])->with('add', $message);
    }

    public function show($orgId, $isInvite)
    {
        $currOrg = Organization::with('studentOrg')->where('id', '=', $orgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = $isInvite;
        
        return view('_student-organization.roles', compact('currOrg', 'orgMembers', 'invite'));
    }

    public function edit($orgId, $isEdit, $memberId)
    {

        $currOrg = Organization::with('studentOrg')->where('id', '=', $orgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = false;

        
        $selected = User::findorfail($memberId);
        
        return view('_student-organization.roles', compact('currOrg', 'orgMembers', 'invite', 'selected'));
    }

    public function update(Request $request, $orgId, $memberId)
    {

        $currOrg = Organization::with('studentOrg')->where('id', '=', $orgId)->first();
        $orgMembers = $currOrg->studentOrg;
        $invite = false;

        $selected = User::findorfail($memberId);

        // $member = $selected->id;
        // dd($selected->role->first()->id);

        $formFields = $request->validate([
            'position' => 'required|max:30',
            'role' => 'required' 
        ]);

        //capitalized first letter of position
        $position = ucfirst($request->position);

        
        $selected->studentOrg()->update(['position' => $position, 'role' => $request->role]);


        $message = $selected->firstName.' '.$selected->lastName.' was succesfully edited!';

        return Redirect::route('organization.show', ['id'=>$currOrg->id, 'invite' => 'false'])->with('edit', $message);
    }

    public function destroy($id)
    {
        //
    }
}
