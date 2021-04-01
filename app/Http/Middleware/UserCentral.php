<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCentral
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $guards = ['customers', 'admins', 'gardners'];
        // return response()->json(Auth::guard('admins')->user());
        foreach ($guards as $guard) {
            $user = Auth::guard($guard)->user();
            if ($user != null) {
                $request->attributes->set('user', $user);
            }
        }
        return $next($request);
    }
}
