<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheckController extends Controller
{
    public function authCheck(){
        if(Auth::check()){
            return response()->json(['auth'=>true, 'nickname'=>Auth::user()->name]);
        }
        return response()->json(['auth'=> false]);
    }
}
