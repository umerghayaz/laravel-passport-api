<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
class AuthController extends Controller
{
    
    public function Login(Request $request){

    	try{

    		if (Auth::attempt($request->only('email','password'))) {
    			$user = Auth::user();
    			$token = $user->createToken('app')->accessToken;

    			return response([
    				'message' => "Successfully Login",
    				'token' => $token,
    				'user' => $user
    			],200); // States Code
    		}

    	}catch(Exception $exception){
    		return response([
    			'message' => $exception->getMessage()
    		],400);
    	}
    	return response([
    		'message' => 'Invalid Email Or Password' 
    	],401);

    } // end method 
}
