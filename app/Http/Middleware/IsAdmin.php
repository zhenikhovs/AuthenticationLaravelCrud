<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $userRole = 'none';
        if(Auth::user()){
            $userRole = Role::where('id','=',Auth::user()->role_id)->get()->first()->name;
        }
        abort_unless(auth()->check() && $userRole === $role, 403, "You don't have permissions to access this area");
        return $next($request);
    }
}
