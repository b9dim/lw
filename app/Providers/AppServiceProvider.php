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
        
        // فرض HTTPS دائماً في production أو إذا كان APP_URL يبدأ بـ https://
        // هذا يضمن أن جميع الروابط تستخدم HTTPS حتى لو لم يتم اكتشاف البروكسي بشكل صحيح
        $appUrl = config('app.url', '');
        $isProduction = $this->app->environment('production');
        $hasHttpsUrl = str_starts_with($appUrl, 'https://');
        
        if ($isProduction || $hasHttpsUrl) {
            // فرض HTTPS scheme دائماً
            URL::forceScheme('https');
            
            // فرض APP_URL إذا كان مضبوطاً بشكل صحيح
            if ($hasHttpsUrl) {
                URL::forceRootUrl($appUrl);
            }
        }
        
        // إضافة helper function لضمان HTTPS في assets
        if (!function_exists('secure_asset_url')) {
            function secure_asset_url($path) {
                // استخدام secure_asset() إذا كان HTTPS مفعّل، وإلا استخدام asset() مع forceScheme
                if (config('app.url') && str_starts_with(config('app.url'), 'https://')) {
                    return secure_asset($path);
                }
                // إذا كان forceScheme('https') مفعّل، asset() سينتج HTTPS تلقائياً
                return asset($path);
            }
        }
    }
}

