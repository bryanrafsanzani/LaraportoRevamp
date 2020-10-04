<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = "settings";
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
}
