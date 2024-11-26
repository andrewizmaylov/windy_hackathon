<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
	    $validApiKey = '1269a569599ec5c0a36edb03258a106628750ee8213fc21e80219f3cf32e5baf';

	    $authorizationHeader = $request->header('Authorization');

	    if (!$authorizationHeader || $authorizationHeader !== $validApiKey) {
		    return response()->json(['error' => 'Unauthorized'], 401);
	    }

	    return $next($request);
    }
}
