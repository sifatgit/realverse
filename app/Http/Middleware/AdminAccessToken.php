<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle(Request $request, Closure $next)
{
    // If token is already verified in session, allow access


    // Get secret token from .env
    $secretToken = env('ADMIN_ACCESS_TOKEN');

    // Check if token is provided either in query or header
    $tokenFromHeader = $request->header('X-Admin-Token');
    $tokenFromQuery = $request->query('admin_token');

    if ($tokenFromHeader === $secretToken || $tokenFromQuery === $secretToken) {
        // Store verified flag in session

        return $next($request);
    }

    abort(403, 'Unauthorized access.');
}

}
