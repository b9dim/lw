<?php

if (! function_exists('force_https_asset')) {
    /**
     * Build an HTTPS asset URL when forcing HTTPS is enabled.
     */
    function force_https_asset(?string $path = null): string
    {
        $path ??= '';

        $forcedUrl = \App\Support\HttpsUrl::asset($path);

        if ($forcedUrl !== null) {
            return $forcedUrl;
        }

        return asset($path);
    }
}

namespace App\Providers;

use App\Support\HttpsUrl;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (HttpsUrl::shouldForce()) {
            URL::forceScheme('https');
        }
    }
}
