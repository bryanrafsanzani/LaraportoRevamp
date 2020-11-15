<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index(Request $request, $logs = null, $filter = null)
    {
        if($request->has('filter')){
            $rules     = [
                'filter'   => 'required|in:today,yesterday,this-week,this-month',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return  \MessageHelper::unprocessableEntity($validator->messages());
            }

            $filter = ' with filter '.$request->filter;

            switch ($request->filter) {
                case 'today':
                    $logs = Log::whereDate('access_date', Carbon::today())->get();
                  break;
                case 'yesterday':
                    $logs = Log::whereDate('access_date', Carbon::now()->addDay(-1))->get();
                  break;
                case 'this-week':
                    $logs = Log::where('access_date', '>=', Carbon::now()->subDays(7)->startOfDay())->get();
                  break;
                case 'this-month':
                    $logs = Log::whereYear('access_date', Carbon::now()->year)
                    ->whereMonth('access_date', Carbon::now()->month)
                    ->get();
                  break;
                default:
                $logs = Log::all();
              }

        }else{
            $logs = Log::all();
        }

        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  "Success, " .$logs->count(). " data Log found".$filter,
            "data"      =>  $logs
        ], \HttpStatus::OK);
    }
}
