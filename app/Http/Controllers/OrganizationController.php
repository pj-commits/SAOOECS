<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Helper\Helper;

class OrganizationController extends Controller
{
    public function index()
    {
        $getAuthOrgList = Auth::user()->studentOrg;

        //Pagination
        $authOrgList = Helper::paginate($getAuthOrgList, count($getAuthOrgList), 10); 

        return view('_users.organization-list', compact('authOrgList'));
    }



    public function show($orgId)
    {
        Helper::isAuthorized('Moderator|Viewer|Editor', $orgId);
        $currOrg = Organization::with('studentOrg')->where('id', '=', $orgId)->first();
        $getOrgMembers = $currOrg->studentOrg;
        $totalMembers = count($getOrgMembers);
    
        $orgMembers = Helper::paginate($getOrgMembers, count($getOrgMembers), 10);
        
        return view('_users.organization-info', compact('currOrg', 'orgMembers', 'totalMembers'));
    }



    public function add($orgId)
    {
        Helper::isAuthorized('Moderator', $orgId);
        $currOrg = Organization::with('studentOrg')->where('id', '=', $orgId)->first();

        return view('_users.organization-add', compact('currOrg'));
    }



    public function store(Request $request, $orgId)
    {  
        //fetch from dummy user api
        //Get key. if user is not in api = error
        $response = json_decode(Http::get('https://sample-user-api.herokuapp.com/users'));
        $key = array_search($request->email, array_column($response, 'email'));

        // // valitdate request
        $request->validate([ 
            'email' =>  [
                'required',
                'email',
                // Rule::unique('user','email'),
                
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

        //Check if user have alredy data on the 'user' table
        if(!User::where('email', $request->email)->exists()){
            $user = User::create([
                'first_name' => $getUser->firstName,
                'middle_name' => $getUser->middleName,
                'last_name' => $getUser->lastName,
                'phone_number' => $getUser->phoneNumber,
                'email' => $getUser->email,
                'user_type' => 'Student',
                'password' => bcrypt($getUser->password)
            ]);

        }else{

            $recruiteeId = User::where('email', $request->email)->first()->id;
            $isUserAlredyInOrg = DB::table('organization_user')->where('organization_id', $orgId)->where('user_id', $recruiteeId)->exists();
            
            //Check if user is already part of the organization
            if($isUserAlredyInOrg){
                $message = 'User is already part of this organization!';
                return redirect()->back()->with('error', $message);
            }else{
                $user = User::findOrFail($recruiteeId);
            }
        }
        
        //capitalized first letter of position
        $position = ucfirst($request->position);
        //attach role, org, position to fetched
        $user->studentOrg()->attach($orgId, ['position' => $position, 'role' => $request->role]);
        $message = $user->first_name.' '. $user->last_name.' was successfully assigned as '. $position.'!';

        //Register the fetched. This will send verification email. Customize the email under resources/views/vendor
        // event(new Registered($user));
    
        return Redirect::route('organization.show', ['id'=>$orgId])->with('add', $message);
    }



    public function select($orgId, $memberId)
    {
        Helper::isAuthorized('Moderator', $orgId);
        $currOrg = Organization::with('studentOrg')->where('id', '=', $orgId)->first();
        $selected = User::findorfail($memberId);

        return view('_users.organization-edit', compact('currOrg','selected'));
    }



    public function update(Request $request, $orgId, $memberId)
    {
        $selected = User::findorfail($memberId);

        $request->validate([
            'position' => 'required|max:30',
            'role' => 'required' 
        ]);

        //capitalized first letter of position
        $position = ucfirst($request->position);
        $selected->studentOrg()->update(['position' => $position, 'role' => $request->role]);
        $message = $selected->first_name.' '.$selected->last_name.' was succesfully edited!';

        return Redirect::route('organization.show', ['id'=>$orgId])->with('edit', $message);
    }



    public function destroy($orgId, $member)
    {
        $selected = User::findorfail($member);
        $selected->studentOrg()->detach($orgId);
        $message = $selected->firstName.' '.$selected->lastName.' was successfully removed from the organization.';
        
        return Redirect::route('organization.show', ['id'=>$orgId])->with('remove', $message);
    }
}
