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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            
            // فرض APP_URL إذا كان مضبوطاً في .env
            $appUrl = config('app.url');
            if ($appUrl && str_starts_with($appUrl, 'https://')) {
                URL::forceRootUrl($appUrl);
            }
        } elseif (str_starts_with(config('app.url', ''), 'https://')) {
            // حتى في غير production، إذا كان APP_URL يبدأ بـ https://، فرض HTTPS
            URL::forceScheme('https');
        }
    }
}

