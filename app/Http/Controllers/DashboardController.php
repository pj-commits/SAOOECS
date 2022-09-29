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
        }elseif(Auth::user()->hasRole('moderator|editor|viewer')){
            return view('_student-organization.dashboard');
        }elseif(Auth::user()->hasRole('sao|acadserv|finance|adviser')){
            return view('_approvers.dashboard');
        }
        return view('_users.dashboard');
    } 

}
