<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class JobPost extends Model
{

    use HasFactory,
    SoftDeletes,
    HasSEO;
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
        'urgent',
        'jobcategories',
    ];

    protected $casts = [
        'date_posted' => 'datetime',
        'status' => 'boolean',
        'featured' => 'boolean',
        'urgent' => 'boolean',
        'job_location' => 'array',
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

    public function getDynamicSEOData(): SEOData
    {
        $pathToFeaturedImageRelativeToPublicPath = null;

        return new SEOData(
            title: $this->title,
            description: $this->post_description,
            image: $pathToFeaturedImageRelativeToPublicPath,
        );
    }
}
