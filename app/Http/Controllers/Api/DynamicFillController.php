<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DynamicFill, App\Models\DynamicForm;

class DynamicFillController extends Controller
{
    public function __construt()
    {
        $this->middleware('jwt.verify');
    }

    public function index()
    {
        $dynamicFills = DynamicFill::all();
        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  "Success, " .$dynamicFills->count(). " data Dynamic Form found",
            "data"      =>  $dynamicFills
        ], \HttpStatus::OK);
    }

    public function store(Request $request)
    {
        $rules     = [
            'dynamic_form_id'   => 'required|numeric',
            'groups'            => 'required|numeric',
            'value'             => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        $check = DynamicForm::where('id', $request->dynamic_form_id)->first();

        if($check){
            DynamicFill::create($request->all());
            return response()->json([
                "code"      =>  \HttpStatus::OK,
                "status"    =>  true,
                "message"   =>  "Success, data Dynamic Fill was inserted!",
                "data"      =>  null
            ], \HttpStatus::OK);
        }

        return response()->json([
            "code"      =>  \HttpStatus::FORBIDDEN,
            "status"    =>  false,
            "message"   =>  "Failed to Store data, Dynamic Form not found",
            "data"      =>  null
            ], \HttpStatus::FORBIDDEN);

    }

    public function view(Request $request)
    {
        $rules     = [
            'id'         => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        $dynamicFill = DynamicFill::with('dynamicForm')->find($request->id);
        if($dynamicFill){
            return response()->json([
                "code"      =>  \HttpStatus::OK,
                "status"    =>  true,
                "message"   =>  "Success, Data Was Found!",
                "data"      =>  $dynamicFill
            ], \HttpStatus::OK);
        }

        return response()->json([
            "code"      =>  \HttpStatus::FORBIDDEN,
            "status"    =>  false,
            "message"   =>  "Failed, Data not Found",
            "data"      =>  null
            ], \HttpStatus::FORBIDDEN);
    }

    public function update(Request $request)
    {
        $rules     = [
            'id'        => 'required',
            'groups'    => 'required|numeric',
            'value'     => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        $dynamicFill = DynamicFill::find($request->id);

        if($dynamicFill){
            $dynamicFill->update($request->only('groups', 'value'));
            return response()->json([
                "code"      =>  \HttpStatus::OK,
                "status"    =>  true,
                "message"   =>  "Success, Data Was Updated!",
                "data"      =>  null
            ], \HttpStatus::OK);
        }

        return response()->json([
            "code"      =>  \HttpStatus::FORBIDDEN,
            "status"    =>  false,
            "message"   =>  "Failed, Data not Found",
            "data"      =>  null
            ], \HttpStatus::FORBIDDEN);
    }

    public function delete($id)
    {
        $dynamicFill = DynamicFill::find($id);

        if($dynamicFill){
            $dynamicFill->delete();
            return response()->json([
                "code"      =>  \HttpStatus::OK,
                "status"    =>  true,
                "message"   =>  "Success, Data Was Deleted!",
                "data"      =>  null
            ], \HttpStatus::OK);
        }
        return response()->json([
            "code"      =>  \HttpStatus::FORBIDDEN,
            "status"    =>  false,
            "message"   =>  "Failed, Data not Found",
            "data"      =>  null
            ], \HttpStatus::FORBIDDEN);
    }
}
