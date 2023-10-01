<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if(Auth::check()) {

            // Check if logged in user is verified and redirect to dashboard
            if(Auth::user()->email_verified_at) {
                return redirect()->route('dashboard');
            }
        }

        // Continue request as user is not authed and/or unverified
        return $next($request);
    }
}
