<?php
namespace App\Helpers;


class MessageHelper
{

    public static function successUpdate($obj)
    {
        return '<i class="fa fa-check-circle"></i> <b>Success!</b>  '.$obj.' has been updated';
    }

    public static function failedUpdate($obj)
    {
        return '<i class="fa fa-times-circle"></i> <b>Failed!</b>  '.$obj.' Cannot been updated';
    }

    public static function errorUpdate($obj)
    {
        return '<i class="fas fa-exclamation-triangle"></i> <b>Error!</b>  '.$obj.' Data tidak ditemukan, Gagal Mengubah';
    }

    public static function successCreate($obj)
    {
        return '<i class="fa fa-check-circle"></i> <b>Success!</b>  '.$obj.' has been Created';
    }

    public static function failedCreate($obj)
    {
        return '<i class="fa fa-exclamation-circle"></i> <b>Failed!</b>  '.$obj.' Cannot been Create';
    }

    public static function unprocessableEntity($validator)
    {
        return response()->json([
            "code"      =>  \HttpStatus::UNPROCESSABLE_ENTITY,
            "status"    =>  false,
            "message"   =>  "form tidak lengkap/sesuai",
            "data"      =>  $validator
        ], \HttpStatus::UNPROCESSABLE_ENTITY);
    }

}