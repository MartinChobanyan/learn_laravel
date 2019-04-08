<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string requiredRoles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$requiredRoles)
    {
        $userRoles = Auth::user()->roles;
        $inersectRoles = array_intersect($requiredRoles, $userRoles);

        if(empty($inersectRoles)) return redirect('/');

        return $next($request);
    }
}