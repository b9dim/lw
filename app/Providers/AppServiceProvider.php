<?php

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
        if (file_exists(app_path('Helpers/ViteHelper.php'))) {
            require_once app_path('Helpers/ViteHelper.php');
        }

        $forceHttps = HttpsUrl::shouldForce();

        if ($forceHttps) {
            URL::forceScheme('https');

            if ($baseUrl = HttpsUrl::baseUrl()) {
                URL::forceRootUrl($baseUrl);
            }
        }

        if (!function_exists('force_https_asset')) {
            function force_https_asset($path) {
                $forced = \App\Support\HttpsUrl::asset($path);

                if ($forced) {
                    return $forced;
                }

                return secure_asset($path);
            }
        }

        if (!function_exists('force_https_route')) {
            function force_https_route($name, $parameters = [], $absolute = true) {
                $forced = \App\Support\HttpsUrl::route($name, $parameters, $absolute);

                if ($forced) {
                    return $forced;
                }

                return route($name, $parameters, $absolute);
            }
        }
    }
}

