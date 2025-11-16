<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Force HTTPS only in production
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Optional: use Bootstrap pagination styling
        Paginator::useBootstrap();
    }
}
