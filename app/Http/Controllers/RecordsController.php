<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordsController extends Controller
{
   public function index(){
        //show pages for differnet users
        if(Auth::user()->hasRole('moderator|editor|viewer')){
            return view('_student-organization.records');
        }elseif(Auth::user()->hasRole('adviser|sao|acadserv|finance')){
            return view('_approvers.records');
        }
        return view('404');
   }
}
