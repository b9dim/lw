<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $isProduction = config('app.env') === 'production';
        $appUrl = config('app.url');
        $hasHttpsUrl = $appUrl && str_starts_with($appUrl, 'https://');
        
        // في production، فرض HTTPS دائماً
        if ($isProduction || $hasHttpsUrl) {
            // التحقق من X-Forwarded-Proto header (لأننا وراء proxy)
            $proto = $request->header('X-Forwarded-Proto') ?? 
                     $request->server('HTTP_X_FORWARDED_PROTO') ?? 
                     null;
            
            // إذا كان الطلب HTTP فعلياً، أعد التوجيه
            if ($proto !== 'https' && str_starts_with($request->url(), 'http://')) {
                $url = str_replace('http://', 'https://', $request->fullUrl());
                return redirect($url, 301);
            }
            
            // فرض HTTPS على الطلب الحالي دائماً في production
            // هذا يضمن أن Laravel يعرف أن الطلب HTTPS
            $request->server->set('HTTPS', 'on');
            $request->server->set('SERVER_PORT', 443);
            $request->server->set('REQUEST_SCHEME', 'https');
            
            // أيضاً فرض على $_SERVER مباشرة
            $_SERVER['HTTPS'] = 'on';
            $_SERVER['SERVER_PORT'] = 443;
            $_SERVER['REQUEST_SCHEME'] = 'https';
        }
        
        return $next($request);
    }
}

