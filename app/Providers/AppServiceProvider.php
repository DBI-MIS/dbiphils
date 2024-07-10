<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Jorenvh\Share\Providers\ShareServiceProvider;

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
    }
}