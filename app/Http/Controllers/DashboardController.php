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
        }elseif(Auth::user()->hasRole('president|secretary|member')){
            return view('dashboard.student');
        }elseif(Auth::user()->hasRole('sao|acadserv|finance')){
            return view('dashboard.approver');
        }
        return view('dashboard.guest');
    } 

}
