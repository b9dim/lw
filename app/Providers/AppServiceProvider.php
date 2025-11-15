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
        
        // فرض HTTPS بشكل جذري في production
        $isProduction = config('app.env') === 'production';
        $appUrl = config('app.url');
        $hasHttpsUrl = $appUrl && str_starts_with($appUrl, 'https://');
        
        // في production، نفرض HTTPS دائماً بغض النظر عن الطلب
        if ($isProduction || $hasHttpsUrl) {
            // فرض HTTPS scheme لجميع الروابط
            URL::forceScheme('https');
            
            // فرض HTTPS root URL إذا كان APP_URL يبدأ بـ https
            if ($hasHttpsUrl) {
                URL::forceRootUrl($appUrl);
            }
            
            // فرض Secure cookies
            config(['session.secure' => true]);
        } else {
            // في development، نتحقق من الطلب الفعلي
            $isSecure = request()->secure() || 
                       request()->header('X-Forwarded-Proto') === 'https' ||
                       request()->server('HTTP_X_FORWARDED_PROTO') === 'https';
            
            if ($isSecure) {
                URL::forceScheme('https');
                config(['session.secure' => true]);
            }
        }
    }
}

