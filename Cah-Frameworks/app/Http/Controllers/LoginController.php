<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['min:8']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return response()->json(['validation' => true]);
        }
        return response()->json(['validation'=>false]);
    }
}
