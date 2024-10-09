<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTestimonial extends Model
{
    use HasFactory;

    protected $casts = [
        'is_featured'  => 'boolean',
    ];

    protected $fillable = [
        'title',
        'img',
        'category',
        'personnel',
        'description',
        'is_featured',
        'order',
     ];
}
