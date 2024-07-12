<?php

namespace App\Models;

use App\ResponseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductResponse extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_title',
        'full_name',
        'date_response',
        'contact',
        'email_address',
        'message',
        'review',
        'status',
    ];

    protected $casts = [
        'date_response' => 'datetime',
        'review' => 'boolean',
        'status' => ResponseStatus::class,
    ];

    public function equipment_title()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_title');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
