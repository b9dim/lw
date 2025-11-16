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
        if (HttpsUrl::shouldForce()) {
            URL::forceScheme('https');
        }
    }
}
