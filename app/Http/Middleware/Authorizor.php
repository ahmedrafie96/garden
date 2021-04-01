<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorizor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->get('user'))
            return response()->json(['error' => 'un authorized'], 401);
        if ($request->get('user')->hasRole($role))
            return $next($request);
        return response()->json(['error' => 'not_permitted'], 422);
    }
}
