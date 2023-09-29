<?php

namespace App\Http\Middleware;

use Closure;
use app\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->is_admin == 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
