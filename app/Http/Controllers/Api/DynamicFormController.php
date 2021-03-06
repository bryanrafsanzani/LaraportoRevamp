<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
            'parent'       => 'required|numeric|max:20',
            'required'     => 'required|in:0,1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }
        $dynamicForm = DynamicForm::create($request->all());
        \LogData::store('Add new Dynamic Form with id='.$dynamicForm->id);

        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  "Success, data Dynamic Form was inserted!",
            "data"      =>  null
        ], \HttpStatus::OK);
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

        $dynamicForm = DynamicForm::with('dynamicFilled')->find($request->id);
        if($dynamicForm){
            return response()->json([
                "code"      =>  \HttpStatus::OK,
                "status"    =>  true,
                "message"   =>  "Success, Data Was Found!",
                "data"      =>  $dynamicForm
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
            'id'           => 'required',
            'name'         => 'required|string|max:181',
            'description'  => 'nullable|string',
            'data_type'    => 'required|in:integer,double,text,long_text,boolean,date,0',
            'parent'       => 'required|numeric|max:20',
            'required'     => 'required|in:0,1',
            'status'       => 'required|in:0,1'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return  \MessageHelper::unprocessableEntity($validator->messages());
        }

        $dynamicForm = DynamicForm::find($request->id);

        if($dynamicForm){
            $dynamicForm->update($request->only('name', 'description', 'data_type', 'parent', 'required', 'status'));
            \LogData::store('Update Dynamic Form with id='.$request->id);
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
        $dynamicForm = DynamicForm::find($id);

        if($dynamicForm){
            \LogData::store('Delete Dynamic Form with id='.$dynamicForm->id);
            $dynamicForm->delete();
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
