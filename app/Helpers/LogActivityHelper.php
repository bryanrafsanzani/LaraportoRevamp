<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Route;
use Request;

class LogActivityHelper
{
    public static function baseLog($msg)
    {
        $array['user_id']      = is_null(auth()->user()) ? 0 : auth()->user()->id;
        $array['ip']           = Request::ip();
        $array['page']         = Request::url();
        $array['method']       = Route::getCurrentRoute()->methods[0];
        $array['route_name']   = Route::currentRouteName();
        $array['data']         = $msg;
        $array['access_date']  = now();
        return $array;
    }


}