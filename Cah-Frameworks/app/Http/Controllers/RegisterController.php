<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class RegisterController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'name' => 'bail|required|unique:users|alpha_num|max:16',
            'email' => 'bail|email|unique:users',
            'password' => 'min:8'
        ]);
        $input = $request->all();

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        return response()->json(['status' => true, 'message'=>"test"]);
    }
}
