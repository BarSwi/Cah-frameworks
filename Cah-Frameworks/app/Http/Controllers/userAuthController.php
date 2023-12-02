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
 
        //Set token duration

            $token = $user->createToken('auth-token', ['none']);
            $accessTokenModel = $token->accessToken;
            $accessTokenModel->expires_at = now()->addMinutes(120);
            $accessTokenModel->save();



        $responseData = ['status' => true, 'name' => $input['name']];

        return response($responseData)->withCookie('auth-token', $token->plainTextToken);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required']
        ]);
        $user = User::where('name', request('name'));

        if(!$user->exists()) return response()->json(['validation'=>false]);

        $user = $user->first();
        

        if(Hash::check(request('password'), $user->getAuthPassword())){
            $token = $user->createToken('auth-token', ['none']);

            //set expiration time
            if(request('remember')===true){
                $token = $user->createToken('auth-token', ['remember']);
            }
            else{
                $accessTokenModel = $token->accessToken;
                $accessTokenModel->expires_at = now()->addMinutes(120);
                $accessTokenModel->save();
            }

            
            $responseData = ['validation' => true];
            return response($responseData)->withCookie('auth-token', $token->plainTextToken); 
        }
    }

    public function authCheck(Request $request){
        return response()->json(['auth' => true, 'nickname' => Auth::user()->name]);
        
        // if (Auth::check()) {
        //     return response()->json(['auth' => true, 'nickname' => Auth::user()->name]);
        // }
       
        // return response()->json(['auth' => false]);

        // Commented code is not required, since this path is guarded by auth:sanctum, uncomment if anything changes.
    }

    public function logout(){
        $user = Auth::user();

        try {
            $cookie = Cookie::forget('auth-token');
            $deletedTokens = $user->tokens()->delete();
            return response()->json(['status' => true])->withCookie($cookie);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()]);
        }
    }
}
