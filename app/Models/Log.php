<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = "logs";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'ip',
        'page',
        'method',
        'route_name',
        'data',
        'access_date',
        'created_at',
        'updated_at',
    ];

    public static function store($data = "")
    {

        return self::create([
            'ip'        =>  request()->ip(),
            'page'      =>  url()->current(),
            'method'    =>  request()->route()->methods()[0],
            // 'route_name'=>  request()->route()->action['as'],
            'data'      =>  $data,
            'access_date'   =>  now()
        ]);
    }
}
