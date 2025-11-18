<?php

namespace App\Support;

class HttpsUrl
{
    /**
     * Determine if HTTPS should be forced globally.
     */
    public static function shouldForce(): bool
    {
        $value = config('app.force_https', false);

        if (is_bool($value)) {
            return $value;
        }

        if (is_string($value)) {
            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        }

        return (bool) $value;
    }

    /**
     * Get the normalized HTTPS base URL that should be forced.
     */
    public static function baseUrl(): ?string
    {
        if (! static::shouldForce()) {
            return null;
        }

        $appUrl = trim((string) config('app.url', ''));

        if ($appUrl === '') {
            try {
                $request = app('request');
                $host = $request?->getHttpHost();
                if ($host) {
                    $appUrl = 'https://' . $host;
                }
            } catch (\Throwable $e) {
                return null;
            }
        }

        if ($appUrl === '') {
            return null;
        }

        $appUrl = rtrim($appUrl, '/');

        if (str_starts_with($appUrl, 'https://')) {
            return $appUrl;
        }

        if (str_starts_with($appUrl, 'http://')) {
            $appUrl = substr($appUrl, 7);
        }

        return 'https://' . ltrim($appUrl, '/');
    }

    /**
     * Build a HTTPS asset URL if forcing is enabled.
     */
    public static function asset(string $path): ?string
    {
        $baseUrl = static::baseUrl();

        if (! $baseUrl) {
            return null;
        }

        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }

    /**
     * Build a HTTPS absolute route URL if forcing is enabled.
     */
    public static function route(string $name, $parameters = [], bool $absolute = true): ?string
    {
        if (! $absolute) {
            return null;
        }

        $baseUrl = static::baseUrl();

        if (! $baseUrl) {
            return null;
        }

        $path = route($name, $parameters, false);

        return rtrim($baseUrl, '/') . $path;
    }
}

