<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicFill extends Model
{
    use HasFactory;

    protected $table = "dynamic_filled";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'dynamic_form_id',
        'groups',
        'value',
        'created_at',
        'updated_at',
        ];
}
