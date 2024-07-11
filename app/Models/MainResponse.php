<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'subject',
        'contact',
        'email',
        'message',
        'review',
        'status',
    ];
    
    protected $casts = [
        'date_response' => 'datetime',
        'review' => 'boolean',
        // 'status' => ResponseStatus::class,
    ];
}
