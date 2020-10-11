<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(Request $request)
    {

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'value'         =>  'required|string|max:255',
            'option_name'   =>  'required|string'
        ]);

        $setting = Setting::where('option_name', $request->option_name)->first();

        if($setting){
            $setting->update($request->only('value'));
        }
    }
}
