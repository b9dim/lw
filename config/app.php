<?php

use Illuminate\Support\Facades\Facade;

return [
    'name' => env('APP_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'force_https' => filter_var(
        env('FORCE_HTTPS', env('APP_ENV', 'production') !== 'local'),
        FILTER_VALIDATE_BOOLEAN
    ),
    'timezone' => env('APP_TIMEZONE', 'Asia/Riyadh'),
    'locale' => env('APP_LOCALE', 'ar'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'ar'),
    'faker_locale' => env('APP_FAKER_LOCALE', 'ar_SA'),
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],
    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],
];

