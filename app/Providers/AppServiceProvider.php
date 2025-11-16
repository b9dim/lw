<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            // فرض HTTPS على جميع الروابط
            URL::forceScheme('https');

            // التأكد من أن الجذر دائماً HTTPS حتى لو كانت قيمة APP_URL تبدأ بـ http://
            $appUrl = config('app.url');

            if (! empty($appUrl) && ! Str::contains($appUrl, ['localhost', '127.0.0.1'])) {
                URL::forceRootUrl(Str::replaceFirst('http://', 'https://', $appUrl));
            }
        }

        // استخدام Bootstrap في Pagination (اختياري)
        Paginator::useBootstrap();
    }
}
