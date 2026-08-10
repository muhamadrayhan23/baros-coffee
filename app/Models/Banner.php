<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = [
        'nama_banner',
        'gambar',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];
}
