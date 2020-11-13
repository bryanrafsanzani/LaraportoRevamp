<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DynamicForm;

class DynamicFormController extends Controller
{
    public function __construt()
    {
        $this->middleware('jwt.verify');
    }

    public function index(Request $request)
    {
        $dynamicForms = DynamicForm::all();
        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  "Success, " .$dynamicForms->count(). " data Dynamic Form found",
            "data"      =>  $dynamicForms
        ], \HttpStatus::OK);
    }

    public function store(Request $request)
    {
        $rules     = [
            'name'         => 'required|string|max:181',
            'data_type'    => 'required|in:integer,double,text,long_text,boolean,date,0',
            'parent'       => 'required|number|max:20',
            'required'     => 'required|in:0,1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }
        $dynamicForm = DynamicForm::create($request->all());

        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  "Success, data Dynamic Form was inserted!",
            "data"      =>  null
        ], \HttpStatus::OK);

    }
}
