<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimony extends Model
{
    use HasFactory;

    protected $table = 'testimonies';

    protected $fillable = [
        'name',
        'content',
        'image',
        'status',
    ];
}
