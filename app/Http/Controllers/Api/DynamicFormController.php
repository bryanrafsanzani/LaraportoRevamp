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
}
