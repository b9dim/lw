<?php

namespace App\Providers;

use App\Support\HttpsUrl;
use App\Support\PostgresSequence;
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

        PostgresSequence::sync(config('database_sequences.tables', []));
    }
}
