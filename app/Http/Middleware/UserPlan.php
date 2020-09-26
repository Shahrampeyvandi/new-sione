<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class UserPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() || auth()->user()->planStatus()) {
            if (!Auth::guard('admin')->check()) {
                if (auth()->check() && auth()->user()->lastloginip && auth()->user()->lastloginip == $request->ip()) {
                    return $next($request);
                } elseif (Auth::guard('admin')->check()) {
                    return $next($request);
                } else {
                    Auth::logout();
                }
            } else {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
