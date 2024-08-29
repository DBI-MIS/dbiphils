<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\JobPost;
use App\Models\Post;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // For example, passing the latest JobPost and Post to all views
        View::composer('layouts.app', function ($view) {
            $jobPost = JobPost::latest()->first();
            $post = Post::latest()->first();

            $view->with('jobPost', $jobPost)->with('post', $post);
        });
    }

    public function register()
    {
        //
    }
}

