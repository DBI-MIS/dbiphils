<?php

namespace App\Providers;

use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Support\Facades\Gate;
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

        DateTimePicker::$defaultDateTimeDisplayFormat = 'm d, Y';

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });
    }
}