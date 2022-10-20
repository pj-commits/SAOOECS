<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordsController extends Controller
{
   public function index(){
        //show pages for differnet users
        if(Auth::user()->checkUSerType('Student|Staff|Professor')){
            return view('_users.records');
        }
        return abort('404');
   }
}
