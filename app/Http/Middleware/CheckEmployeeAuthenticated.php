<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmployeeAuthenticated
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
        // Check if the employee is authenticated
        if (!Auth::guard('employee')->check()) {
            // Redirect to the login page if not authenticated
            return redirect()->route('employee.login.form')->with('error', 'You must be logged in to access that page.');
        }

        return $next($request);
    }
}