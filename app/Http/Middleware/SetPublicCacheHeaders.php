<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetPublicCacheHeaders
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (
            ! $request->isMethod('GET')
            || $request->is('admin*')
            || ! $response->isSuccessful()
        ) {
            return $response;
        }

        if (app()->environment('production')) {
            $response->headers->set('Cache-Control', 'public, max-age=300, stale-while-revalidate=60');
        }

        return $response;
    }
}
