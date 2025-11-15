<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'يجب تسجيل الدخول أولاً'
                ], 401);
            }
            return redirect()->route('login');
        }

        $user = auth()->user();
        if (!$user->isAdmin() && !$user->isLawyer() && !$user->isReception()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'غير مصرح لك بالوصول إلى هذه الصفحة.'
                ], 403);
            }
            abort(403, 'غير مصرح لك بالوصول إلى هذه الصفحة.');
        }

        return $next($request);
    }
}

