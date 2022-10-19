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
        $try = OrganizationUser::all();

        //show pages for differnet users
        if(Auth::user()->hasRole('root')){
            return view('dashboard.root');
        }elseif(Auth::user()->checkUserType('Student')){
            return view('_student-organization.dashboard', compact('myForms', 'try'));
        }elseif(Auth::user()->checkUserType('Professor|Staff')){
            $pendingForms = [
                [
                    'id' => '1',
                    'eventTitle' => 'HigmigKantuhan',
                    'eventDate' => '10/11/22',
                    'formType' => 'APF'
                ],
                [
                    'id' => '3',
                    'eventTitle' => 'HigmigKantuhan',
                    'eventDate' => '10/11/22',
                    'formType' => 'BRF'
                ],
                [
                    'id' => '4',
                    'eventTitle' => 'HigmigKantuhan',
                    'eventDate' => '10/11/22',
                    'formType' => 'NR'
                ],
                [
                    'id' => '5',
                    'eventTitle' => 'HigmigKantuhan',
                    'eventDate' => '10/11/22',
                    'formType' => 'LF'
                ],
                [
                    'id' => '2',
                    'eventTitle' => 'Isawa mo at isasayaw ko',
                    'eventDate' => '10/12/2022',
                    'formType' => 'APF'
                ],
            ];
            return view('_approvers.dashboard')->with('pendingForms', $pendingForms);
        }
        return view('_users.dashboard');
    } 

}
