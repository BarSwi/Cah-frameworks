<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Cookie;
// use Illuminate\Support\Facades\Session;


class userAuthController extends Controller
{
    public function register(Request $request){

        $email_regex = 'regex:/^([A-Za-z0-9.\-]*\w)+@+([A-Za-z0-9\-]*\w)+(\.[A-Za-z]*\w)+$/';

        $request->validate([
            'name' => ['bail','required','unique:users','alpha_num' ,'max:16'],
            'email' => ['bail','nullable','unique:users', $email_regex],
            'password' => 'min:8'
        ], ['name.unique' => 'Name Taken', 'email.unique' => 'Email Taken']);
        $input = $request->all();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        auth()->login($user);   
        $token = $user->createToken('auth-token')->plainTextToken;
        

        return response()->json(['status' => true, 'name' => $input['name'],'token'=>$token]);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);

        $name = $credentials['name'];
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
           // $request->session()->regenerate();

            return response()->json(['validation' => true, 'nickname'=> $name,'token'=>$token]);
        }
        return response()->json(['validation'=>false]);
    }

    public function authCheck(Request $request){
        if (Auth::check()) {
            return response()->json(['auth' => true, 'nickname' => Auth::user()->name]);
        }

        return response()->json(['auth' => false]);
    }

    public function logout(){
        $user = Auth::user();

        try {
            $deletedTokens = $user->tokens()->delete();
            //Session::flush();
            return response()->json(['status' => true, 'deleted_tokens' => $deletedTokens]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
