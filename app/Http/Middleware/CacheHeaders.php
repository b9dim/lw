<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheHeaders
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
        $response = $next($request);
        
        // إضافة cache headers للصفحات العامة فقط
        if ($request->is('/') || 
            $request->is('about') || 
            $request->is('services') || 
            $request->is('contact')) {
            $response->header('Cache-Control', 'public, max-age=3600'); // ساعة واحدة
            $response->header('Expires', gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
        }
        
        return $response;
    }
}

