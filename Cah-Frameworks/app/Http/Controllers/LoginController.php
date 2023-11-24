<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);

        $name = $credentials['name'];
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return response()->json(['validation' => true, 'nickname'=> $name]);
        }
        return response()->json(['validation'=>false]);
    }
}
