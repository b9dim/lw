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
        
        // في production، فرض HTTPS redirect فقط إذا كان الطلب HTTP فعلياً
        if ($isProduction || $hasHttpsUrl) {
            // التحقق من أن الطلب ليس HTTPS بالفعل
            // نتحقق من X-Forwarded-Proto header أولاً (لأننا وراء proxy)
            $proto = $request->header('X-Forwarded-Proto') ?? 
                     $request->server('HTTP_X_FORWARDED_PROTO') ?? 
                     ($request->secure() ? 'https' : 'http');
            
            // إذا كان الطلب HTTP فعلياً (وليس HTTPS)، أعد التوجيه
            if ($proto !== 'https' && str_starts_with($request->url(), 'http://')) {
                $url = str_replace('http://', 'https://', $request->fullUrl());
                return redirect($url, 301);
            }
        }
        
        return $next($request);
    }
}

