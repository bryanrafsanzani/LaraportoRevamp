<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class LogController extends Controller
{
    public function index(Request $request)
    {

    }

    public function datatables()
    {
        return Datatables::of(Role::All())
        ->addIndexColumn()
        ->editColumn('name',
            function ($data){
                return '$data->name;';
        })
        // ->rawColumns(['action'])
        ->make(true);
    }
}
