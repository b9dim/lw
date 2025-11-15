<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // تحميل helper functions
        if (file_exists(app_path('Helpers/ViteHelper.php'))) {
            require_once app_path('Helpers/ViteHelper.php');
        }
        
        // فرض HTTPS في production أو عندما يكون الطلب HTTPS
        if (config('app.env') === 'production' || 
            request()->secure() || 
            request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }
    }
}

