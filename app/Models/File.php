<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class File extends Model
{
    protected $fillable = [
        'guid',
        'size',
        'mime_type',
        'path'
    ];

}
