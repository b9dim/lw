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
        $isProduction = config('app.env') === 'production';
        $isSecure = request()->secure() || request()->header('X-Forwarded-Proto') === 'https';
        $appUrl = config('app.url');
        $hasHttpsUrl = $appUrl && str_starts_with($appUrl, 'https://');
        
        if ($isProduction || $isSecure || $hasHttpsUrl) {
            URL::forceScheme('https');
        }
        
        // فرض Secure cookies في production
        if ($isProduction || $hasHttpsUrl) {
            config(['session.secure' => true]);
        }
    }
}

