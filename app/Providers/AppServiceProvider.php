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
        
        // إضافة helper function لضمان HTTPS في assets دائماً
        if (!function_exists('force_https_asset')) {
            function force_https_asset($path) {
                // بناء رابط HTTPS يدوياً لضمان HTTPS دائماً
                $appUrl = config('app.url', '');
                
                // إذا كان APP_URL يبدأ بـ https://، استخدمه مباشرة
                if (str_starts_with($appUrl, 'https://')) {
                    $baseUrl = rtrim($appUrl, '/');
                    $assetPath = ltrim($path, '/');
                    return $baseUrl . '/' . $assetPath;
                }
                
                // وإلا استخدم secure_asset() كـ fallback
                return secure_asset($path);
            }
        }
        
        // إضافة helper function لضمان HTTPS في routes دائماً
        if (!function_exists('force_https_route')) {
            function force_https_route($name, $parameters = [], $absolute = true) {
                // بناء رابط HTTPS يدوياً لضمان HTTPS دائماً
                $appUrl = config('app.url', '');
                $isProduction = app()->environment('production');
                
                // في production أو إذا كان APP_URL يبدأ بـ https://، استخدم HTTPS مباشرة
                if ($isProduction || str_starts_with($appUrl, 'https://')) {
                    // بناء رابط HTTPS يدوياً
                    if (str_starts_with($appUrl, 'https://')) {
                        $baseUrl = rtrim($appUrl, '/');
                    } elseif (!empty($appUrl)) {
                        $host = parse_url($appUrl, PHP_URL_HOST) ?: str_replace(['http://', 'https://'], '', $appUrl);
                        $baseUrl = 'https://' . rtrim($host, '/');
                    } else {
                        // إذا كان APP_URL فارغاً، استخدم route() العادي
                        return route($name, $parameters, $absolute);
                    }
                    
                    // الحصول على المسار من route() بدون scheme
                    $routePath = route($name, $parameters, false);
                    return $baseUrl . $routePath;
                }
                
                // وإلا استخدم route() العادي
                return route($name, $parameters, $absolute);
            }
        }
    }
}

