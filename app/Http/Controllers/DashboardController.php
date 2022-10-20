<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
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
