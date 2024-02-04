<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreeDRedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, $guard="threed")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('login3d'));
        }
        return $next($request);
    }
}
