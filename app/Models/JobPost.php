<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class JobPost extends Model
{

    use HasFactory,
    SoftDeletes;
    // HasFilamentComments;

    protected $fillable = [
        'user_id',
        'title',
        'date_posted',
        'job_category',
        'job_level',
        'job_location',
        'job_type',
        'post_description',
        'post_responsibility',
        'post_qualification',
        'slug',
        'status',
        'featured',
        'jobcategories',
    ];

    protected $casts = [
        'date_posted' => 'datetime',
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jobresponse()
    {
        return $this->belongsTo(JobResponse::class, 'post_title');
    }


    public function jobcategories()
    {
        return $this->belongsToMany(JobCategory::class, 'job_category_post');
    }

    public function jobresponses()
    {
        return $this->belongsToMany(JobResponse::class);
    }


    public function scopePublished($query)
    {
        $query->where('date_posted', '<=', Carbon::now());
    }

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('jobcategories', function($query) use ($category)
        {
            $query->where('slug', $category);
        });
    }

    public function scopeSearch($query, ?string $search = '')
    {
        $query->where('title', 'like', "%{$search}%");
    }

    public function getExcerpt() 
    {
        return Str::limit(strip_tags($this->post_description), 200);
    }
}
