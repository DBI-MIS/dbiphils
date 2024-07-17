<?php

namespace App\Models;

use App\ResponseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobResponse extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use Notifiable;

    // public function routeNotificationForMail(ResponseUpdate $notification): array|string
    // {   
    //     $email_address = "ggcmis@dbiphils.com";
    //     // Return email address only...
    //     return $email_address;
    // }

    protected $fillable = [
        'post_id',
        'full_name',
        'date_response',
        'contact',
        'email_address',
        'current_address',
        'attachment',
        'review',
        'status',
        'post_title'
    ];
    
    protected $casts = [
        'date_response' => 'datetime',
        'review' => 'boolean',
        // 'status' => ResponseStatus::class,
        // 'attachment' => 'array',
    ];
    public function job_title()
    {
        return $this->belongsTo(JobPost::class, 'post_id');
    }
    
    public function job_post()
    {
        return $this->belongsTo(JobPost::class, 'post_title');
    }

    public function job_posts()
    {
        return $this->belongsToMany(JobPost::class);
    }

}
