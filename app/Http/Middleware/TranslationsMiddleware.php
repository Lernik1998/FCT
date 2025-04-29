<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TranslationsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // app()->setLocale($request->cookie('locale') ?? 'es'); // TODO: Set the locale from the cookie
        app()->setLocale(config('app.locale'));

        if(session()->has('locale')) {
            app()->setLocale(session('locale'));
        }
        return $next($request);
    }
}
