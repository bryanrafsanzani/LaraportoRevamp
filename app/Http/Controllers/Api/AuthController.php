<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Notifications\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
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

    public function resetPassword(Request $request)
    {
        $rules     = [
            'token'         => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        if($request->has('token')){
            $token = DB::table('reset_password')->where('token', $request->token)->first();

            if($token){
                $date = Carbon::parse($token->created_at);

                if($date->diffInSeconds(Carbon::now()) >= 1800){//more than 30 minutes
                    $message = 'Your Token was Expired, please request another token ';
                }else{
                    $user = User::where('email', $token->email)->first();

                    if(!$user){
                        $message = 'Account or Token was invalid';
                    }else{

                        return response()->json([ //after this return, redirect back and post with same url but different method
                            "code"      =>  \HttpStatus::OK,
                            "status"    =>  true,
                            "message"   =>  'Success, Token is Valid',
                            "data"      =>  null
                            ], \HttpStatus::OK);
                    }

                }
            }else{
                $message = 'Token Invalid, please request another token ';
            }
        }else{
            $message= "Token is required";
        }

        return response()->json([
            "code"      =>  \HttpStatus::FORBIDDEN,
            "status"    =>  false,
            "message"   =>  $message,
            "data"      =>  null
            ], \HttpStatus::FORBIDDEN);
    }

    public function submitResetPassword(Request $request)
    {
        $rules     = [
            'token'                 => 'required|string',
            'password'              =>  'required|string|min:8|max:190',
            'password_confirmation' =>  'required|string|max:190|same:password'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        $token = DB::table('reset_password')->where('token', $request->token)->first();

        if($token){
            $date = Carbon::parse($token->created_at);

            if($date->diffInSeconds(Carbon::now()) >= 1800){//more than 30 minutes
                $message = 'Your Token was Expired, please request another token ';
            }else{
                $user = User::where('email', $token->email)->first();

                if(!$user){
                    $message = 'Account or Token was invalid';
                }else{

                    $user->update(['password'  =>  bcrypt($request->password)]);
                    DB::table('reset_password')->where('token', $request->token)->delete();

                    return response()->json([ //after this return, redirect back and post with same url but different method
                        "code"      =>  \HttpStatus::OK,
                        "status"    =>  true,
                        "message"   =>  'Success, Password was updated',
                        "data"      =>  null
                        ], \HttpStatus::OK);
                }
            }
        }else{
            $message = 'Token Invalid, please request another token';
        }

        return response()->json([
            "code"      =>  \HttpStatus::FORBIDDEN,
            "status"    =>  false,
            "message"   =>  $message,
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
