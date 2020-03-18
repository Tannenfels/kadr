<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LegacyRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $pattern1 = '(page\.php\?id=\d+)';
        $pattern2 = '(page-id-\d+-\S+)';
        if (preg_match($pattern1, $request->path()) === 1 || preg_match($pattern2, $request->path()) === 1){
            return redirect()->route('show');
        }
        return $next($request);
    }
}
