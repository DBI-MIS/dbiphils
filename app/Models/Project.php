<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at'  => 'date: m d, Y',
        'status' => 'boolean',
        'featured' => 'boolean',
        'tag' => 'array',
        'category' => 'array',
    ];

    protected $fillable = [
        'name',
        'img',
        'address',
        'description',
        'category',
        'tag',
        'slug',
        'status',
        'featured',
        'published_at',
        
    ];

    public function getExcerpt() 
    {
        return Str::limit(strip_tags($this->description), 50);
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
