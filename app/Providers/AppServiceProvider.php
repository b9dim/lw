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
        
        // فرض HTTPS في production أو عندما يكون الطلب عبر HTTPS
        // هذا يضمن أن جميع الروابط تستخدم HTTPS في بيئة الإنتاج
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        } elseif (request()->secure() || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }
        
        // فرض HTTPS إذا كان APP_URL يبدأ بـ https
        $appUrl = config('app.url');
        if ($appUrl && str_starts_with($appUrl, 'https://')) {
            URL::forceScheme('https');
        }
    }
}

