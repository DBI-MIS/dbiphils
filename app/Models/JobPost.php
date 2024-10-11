<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\LaravelMarkdown\MarkdownRenderer;

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

    public function scopeUrgent($query)
    {
        return $query->where('urgent', true);
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
        $query->whereHas('jobcategories', function ($query) use ($category) {
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

    public function markdowntransform()
    {
        return app(MarkdownRenderer::class)->toHtml($this->post_description);
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

    public function getDatePosted()
    {
        return $this->date_posted->toDateString();
    }

    public function getValidThrough()
    {
        return $this->date_posted->copy()->addYear()->toDateString();
    }

    private const JOB_TYPES = [
        'Full Time' => 'FULL_TIME',
        'Part Time' => 'PART_TIME',
        'Internship' => 'INTERN',
    ];

    public function getJobTypeName(): string
    {
        return match ($this->job_type) {
            'Full Time' => self::JOB_TYPES['Full Time'],
            'Part Time' => self::JOB_TYPES['Part Time'],
            'Internship' => self::JOB_TYPES['Internship'],
            default => 'Unknown',
        };
    }
}
