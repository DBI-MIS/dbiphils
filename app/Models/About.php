<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

            protected $casts = [
                'desc_array' => 'array',
                'img' => 'array'
            ];
        
            protected $fillable = [
                'title',
                'img',
                'description',
                'desc_array',        
            ];
}
