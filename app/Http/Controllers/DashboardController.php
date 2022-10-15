<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        //show pages for differnet users
        if(Auth::user()->hasRole('root')){
            return view('dashboard.root');
        }elseif(Auth::user()->checkUserType('Student')){
            return view('_student-organization.dashboard');
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
