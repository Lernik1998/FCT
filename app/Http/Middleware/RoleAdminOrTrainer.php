<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleAdminOrTrainer
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && in_array(auth()->user()->role, ['admin', 'trainer'])) {
            return $next($request);
        }

        abort(403); // O redirigir si prefieres
    }
}
