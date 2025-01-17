<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matrix extends Model
{
    use HasFactory;

    protected $fillable = [
        'length',
        'height',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
