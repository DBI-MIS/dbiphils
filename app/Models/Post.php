<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Str;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class Post extends Model
{
    use HasFactory, HasSEO;

    protected $casts = [
        'created_at'  => 'date: m d, Y',
        'published_at'  => 'date',
        'is_featured' => 'boolean',
        'content' => 'string'
    ];

    protected $fillable = [
        'title',
        'img',
        'content',
        'category',
        'slug',
        'published_at',
        'is_featured',        
    ];

    public function getExcerpt() 
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    public function markdowntransform() 
    {
        // return Str::markdown($this->content);
        return app(MarkdownRenderer::class)->toHtml($this->content);
    }

    public function getDynamicSEOData(): SEOData
    {
        $pathToFeaturedImageRelativeToPublicPath =  '/storage/'.$this->img;

        return new SEOData(
            title: $this->title,
            description: $this->getExcerpt(),
            image: $pathToFeaturedImageRelativeToPublicPath,
        );
    }

    public function getDatePublished()
    {
        $publishedAt = $this->published_at->copy(); // Copy to avoid modifying the original timestamp
        $publishedAt->setTimezone('Asia/Manila');
        return $publishedAt->format(DateTime::ATOM); // ISO 8601 format
    }
    
    public function getDateModified()
    {
        $updatedAt = $this->updated_at->copy(); // Copy to avoid modifying the original timestamp
        $updatedAt->setTimezone('Asia/Manila');
        return $updatedAt->format(DateTime::ATOM); // ISO 8601 format
    }

}
