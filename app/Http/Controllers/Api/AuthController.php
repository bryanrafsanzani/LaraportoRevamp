<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        //
    }

    public function login(Request $request)
    {
        $rules     = [
            'email'         => 'required|string|max:100',
            'password'      => 'required|min:4|max:190',
            'fcm_token'     => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        $token = \JWTAuth::attempt($request->only('email', 'password'));

        if($token){
            $user      = \Illuminate\Support\Facades\Auth::user();

            if($user->type === \App\User::TYPE_USER){
                $user->update([
                    'fcm_token' => $request->fcm_token
                ]);

                DB::table('autherization_token')->insert([
                    'token'     =>  $token,
                    'user_id'   =>  Auth::user()->id,
                    'created_at'=>  now(),
                    'ip_address'=>  'null'
                ]);

                return response()->json([
                    "code"      =>  \HttpStatus::OK,
                    "status"    =>  true,
                    "message"   =>  "Success Login",
                    "data"      =>  [
                                    'token'     => "Bearer ".$token
                                ]
                    ], \HttpStatus::OK);
            }
            return response()->json([
                "code"      =>  \HttpStatus::FORBIDDEN,
                "status"    =>  false,
                "message"   =>  "Failed Login, User Contact Cannot Login!",
                "data"      =>  null
                ], \HttpStatus::FORBIDDEN);
        }

        return response()->json([
            "code"      =>  \HttpStatus::FORBIDDEN,
            "status"    =>  false,
            "message"   =>  "Failed Login, Email or Password Wrong!",
            "data"      =>  null
            ], \HttpStatus::FORBIDDEN);
    }
}
