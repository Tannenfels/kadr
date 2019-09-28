<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && in_array('admin', explode(',', Auth::user()->user_groups))){
            return $next($request);
        };
        abort(404,'Page not found');
        return null;
    }
}
