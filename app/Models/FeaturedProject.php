<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedProject extends Model
{
    use HasFactory;

    protected $casts = [
        'is_featured'  => 'boolean',
    ];

    protected $fillable = [
       'title',
        'img',
       'category',
        'description',
        'is_featured',
    ];
}
