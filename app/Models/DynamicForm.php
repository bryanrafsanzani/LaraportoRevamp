<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicForm extends Model
{
    use HasFactory;

    protected $table = "dynamic_forms";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'name',
        'description',
        'data_type',
        'parent',
        'required',
        'status',
        'created_at',
        'updated_at',
        ];

    public function dynamicFilled()
    {
        return $this->hasMany('App\Models\DynamicFill', 'dynamic_form_id', 'id');
    }
}
