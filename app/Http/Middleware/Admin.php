<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AdminController;
use Closure;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if (Auth::user()){
            $userId = Auth::user()->id;
            $roles = DB::select("
                SELECT roles_users.role_id FROM roles_users WHERE user_id = $userId
            ");

            if (!empty($roles)) {
                foreach ($roles as $role) {
                    if (in_array($role->role_id, AdminController::ADMIN_ACCESS)){
                        return $next($request);
                    }
                }
            }
        }
        /*if (Auth::user() && in_array('admin', explode(',', Auth::user()->user_groups))){
            return $next($request);
        }*/
        abort(404,'Page not found');
        return null;
    }
}
