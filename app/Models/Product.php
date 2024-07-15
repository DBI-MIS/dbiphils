<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'title',
        'product_img',
        'user_id',
        'date_posted',
        'description',
        'features',
        'technical_specs',
        'slug',
        'capacity',
        'equipment_application',
        'equipment_header',
        'equipment_type',
        'equipment_group',
        'product_categories',
        'brand_id',
        'status',
        'featured',
        'product_brand',
    ];

    protected $casts = [
        'date_posted' => 'datetime',
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product_brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


    public function product_categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopePublished($query)
    {
        $query->where('date_posted', '<=', Carbon::now());
    }

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('product_categories', function($query) use ($category)
        {
            $query->where('slug', $category);
        });
    }

    public function getExcerpt() 
    {
        return Str::limit(strip_tags($this->description), 100);
    }
}
