<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class LogController extends Controller
{

    public function datatables()
    {
        return Datatables::of(Role::All())
            ->addIndexColumn()
            ->editColumn('name',
                function ($data){
                    return '$data->name;';
            })
            ->make(true);
    }

    public function index()
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function delete($Id)
    {

    }
}
