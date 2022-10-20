<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        //Fetch form with event id na org id == myorglist
        $authOrgList = Auth::user()->studentOrg->pluck('id')->toArray();
        $myForms = Form::whereIn('organization_id', $authOrgList)->get();

        //show pages for differnet users
        if(Auth::user()->checkUserType('Student')){
            return view('_student-organization.dashboard');
        }elseif(Auth::user()->checkUserType('Professor|Staff')){
            $pendingForms = [
                [
                    'id' => '1',
                    'organization' => 'Brewing Minds',
                    'eventTitle' => 'Hour of Code',
                    'formType' => 'APF',
                    'deadline' => '10/21/22',
                    'dateSubmitted' => '10/18/22',    
                ],
                [
                    'id' => '2',
                    'organization' => 'Brewing Minds',
                    'eventTitle' => 'Hour of Code',
                    'formType' => 'BRF',
                    'deadline' => '10/21/22',
                    'dateSubmitted' => '10/18/22',    
                ],
                [
                    'id' => '3',
                    'organization' => 'Brewing Minds',
                    'eventTitle' => 'Hour of Code',
                    'formType' => 'NR',
                    'deadline' => '10/21/22',
                    'dateSubmitted' => '10/18/22',    
                ],
                [
                    'id' => '4',
                    'organization' => 'Brewing Minds',
                    'eventTitle' => 'Hour of Code',
                    'formType' => 'LF',
                    'deadline' => '10/21/22',
                    'dateSubmitted' => '10/18/22',    
                ],
                [
                    'id' => '5',
                    'organization' => 'Bahay Bombilya',
                    'eventTitle' => 'Awitin mo at isasayaw ko',
                    'formType' => 'APF',
                    'deadline' => '10/23/22',
                    'dateSubmitted' => '10/19/22',    
                ],

            ];
            return view('_approvers.dashboard')->with('pendingForms', $pendingForms);
        }
        return view('_users.dashboard');
    } 

}
