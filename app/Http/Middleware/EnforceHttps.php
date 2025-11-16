<?php

namespace App\Http\Middleware;

use App\Support\HttpsUrl;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceHttps
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! HttpsUrl::shouldForce()) {
            return $next($request);
        }

        if ($this->shouldRedirectToHttps($request)) {
            return redirect()->to($this->buildSecureUrl($request), 301);
        }

        $response = $next($request);

        if ($this->isHttpsRequest($request) && ! $response->headers->has('Strict-Transport-Security')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=63072000; includeSubDomains; preload');
        }

        return $response;
    }

    protected function shouldRedirectToHttps(Request $request): bool
    {
        return ! $this->isHttpsRequest($request);
    }

    protected function isHttpsRequest(Request $request): bool
    {
        if ($request->isSecure()) {
            return true;
        }

        $protoHeader = strtolower((string) $request->headers->get('X-Forwarded-Proto'));
        if ($protoHeader && in_array('https', array_map('trim', explode(',', $protoHeader)), true)) {
            return true;
        }

        $scheme = strtolower((string) $request->headers->get('X-Forwarded-Scheme'));
        if ($scheme === 'https') {
            return true;
        }

        $ssl = strtolower((string) ($request->headers->get('X-Forwarded-Ssl') ?? $request->server('HTTP_X_FORWARDED_SSL', '')));
        if ($ssl === 'on') {
            return true;
        }

        $forwarded = strtolower((string) $request->headers->get('Forwarded'));
        return str_contains($forwarded, 'proto=https');
    }

    protected function buildSecureUrl(Request $request): string
    {
        $host = $request->getHttpHost();
        $uri = $request->getRequestUri();

        return 'https://' . $host . $uri;
    }
}

