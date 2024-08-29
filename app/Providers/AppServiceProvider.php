<?php

namespace App\Providers;

use App\Models\JobPost;
use App\Models\Post;
use App\Models\User;
use App\Providers\ViewServiceProvider;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Jorenvh\Share\Providers\ShareServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        ShareServiceProvider::class;
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        ShareServiceProvider::class;

        DateTimePicker::$defaultDateTimeDisplayFormat = 'm d, Y';

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });

        // $jobPost = JobPost::latest()->first();
        // $post = Post::latest()->first();

        // // Share variables across all views
        // View::share('jobPost', $jobPost);
        // View::share('post', $post);
    }
}