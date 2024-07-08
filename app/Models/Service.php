<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $casts = [
        'is_featured'  => 'boolean',
    ];

    protected $fillable = [
        'title',
        'subtitle',
        'img',
        'description',
        'is_featured',
     ];
}
