<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DynamicFill;

class DynamicFillController extends Controller
{
    public function __construt()
    {
        $this->middleware('jwt.verify');
    }

    public function index()
    {
        $dynamicFill = DynamicFill::all();
        return response()->json([
            "code"      =>  \HttpStatus::OK,
            "status"    =>  true,
            "message"   =>  "Success, " .$dynamicForms->count(). " data Dynamic Form found",
            "data"      =>  $dynamicForm
        ], \HttpStatus::OK);
    }

    public function store(Request $request)
    {

    }

    public function view(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete($id)
    {

    }
}
