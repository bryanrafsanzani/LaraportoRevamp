<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Notifications\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify')->only('logout');
    }

    public function login(Request $request)
    {
        $rules     = [
            'email'         => 'required|string|max:100',
            'password'      => 'required|min:4|max:190',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        $token = \JWTAuth::attempt($request->only('email', 'password'));

        if($token){
            $user      = \Illuminate\Support\Facades\Auth::user();

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
            "message"   =>  "Failed Login, Email or Password Wrong!",
            "data"      =>  null
            ], \HttpStatus::FORBIDDEN);
    }

    public function forgotPassword(Request $request)
    {
        $rules     = [
            'email'         => 'required|string|max:100|email',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        $check = User::where('email', $request->email)->first();

        if($check){
            $token = \StringHelper::generateRandomString(128);
            $check->token = $token;

            // User::forgotPassword($check); //send email forgot password

                DB::table('reset_password')->insert([
                    'email' => $request->email,
                    'token' => $token
                ]);


            return response()->json([
                "code"      =>  \HttpStatus::OK,
                "status"    =>  true,
                "message"   =>  "Success Send Link Forgot Password to Email",
                "data"      =>  [
                                'token'     => $token
                            ]
            ], \HttpStatus::OK);
        }

        return response()->json([
            "code"      =>  \HttpStatus::FORBIDDEN,
            "status"    =>  false,
            "message"   =>  "Failed, Email not Found!",
            "data"      =>  null
            ], \HttpStatus::FORBIDDEN);


    }

    public function logout(Request $request)
    {

        \JWTAuth::invalidate($request->header('Authorization'));

        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  'Logout Success',
            "data"      =>  null
            ], \HttpStatus::OK);

    }
}
