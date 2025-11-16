<?php

use App\Support\HttpsUrl;

if (! function_exists('force_https_asset')) {
    /**
     * Build a HTTPS asset URL when forcing HTTPS is enabled.
     */
    function force_https_asset(?string $path = null): string
    {
        $path ??= '';

        $forcedUrl = HttpsUrl::asset($path);

        if ($forcedUrl !== null) {
            return $forcedUrl;
        }

        return asset($path);
    }
}
