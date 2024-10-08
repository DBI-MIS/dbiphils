<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mainpage extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at'  => 'date: m d, Y',
    ];

    protected $fillable = [
        'title',
        'img',
        'section',
        'notes',        
    ];
}
