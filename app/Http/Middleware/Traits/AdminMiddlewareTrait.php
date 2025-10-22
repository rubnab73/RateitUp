<?php

namespace App\Http\Middleware\Traits;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AdminMiddlewareTrait
{
    public function handleAdmin(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized access.'], 403);
            }
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}