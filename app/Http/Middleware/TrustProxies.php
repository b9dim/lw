<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * الثقة في جميع البروكسيات (Render يحتاج هذا)
     */
    protected $proxies = '*';

    /**
     * ضبط الهيدرات الخاصة بـ HTTPS
     * استخدام HEADER_X_FORWARDED_ALL لضمان قراءة جميع الهيدرات من Render proxy
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
