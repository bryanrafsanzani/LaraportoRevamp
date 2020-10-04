<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    protected $table = "uploads";
    protected $primaryKey = "id";

    protected $fillable = [
        'id',
        'author',
        'file_name',
        'file_type',
        'file_path',
        'full_path',
        'raw_name',
        'orig_name',
        'client_name',
        'file_ext',
        'file_size',
        'image_width',
        'image_height',
        'image_type',
        'image_size_str',
        'created_at',
        'updated_at',
        ];
}
