<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class RegisterController extends Controller
{
    public function store(Request $request){

        $email_regex = 'regex:/^([A-Za-z0-9.\-]*\w)+@+([A-Za-z0-9\-]*\w)+(\.[A-Za-z]*\w)+$/';

        $request->validate([
            'name' => ['bail','required','unique:users','alpha_num' ,'max:16'],
            'email' => ['bail','nullable','unique:users', $email_regex],
            'password' => 'min:8'
        ], ['name.unique' => 'Name Taken', 'email.unique' => 'Email Taken']);
        $input = $request->all();

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        return response()->json(['status' => true]);
    }
}
