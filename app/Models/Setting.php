<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = "settings";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'name',
        'option_name',
        'value',
        'default_value',
        'description',
        'created_at',
        'updated_at',
    ];

    public static function fetchValue($option_name){
        $setting = self::where('option_name', $option_name)->first();

        if($setting){
            return $setting->value;
        }
        return null;
    }
}
