<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index()
    {
        $settings = Setting::all();
        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  "Success, " .$settings->count(). " data settings found",
            "data"      =>  $settings
        ], \HttpStatus::OK);
    }

    public function update(Request $request)
    {
        $rules     = [
            'settings'         => 'required|array|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }


        foreach(Setting::All() as $keyParent => $setting){

            foreach($request->settings as $keyChild => $value){

                if($setting->option_name === $keyChild){
                    Setting::where('option_name', $keyChild)->update([
                        'value'     =>  $value,
                        'updated_by'=>  auth()->user()->id,
                        'updated_at'=>  now()
                    ]);
                }
            }
        }

        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  "Success, Global setting was updated",
            "data"      =>  null
        ], \HttpStatus::OK);
    }
}
