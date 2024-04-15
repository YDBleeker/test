<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AssignCookie
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
        // Check if the user already has a cookie
        if (!$request->cookie('user_cookie')) {
            $cookieValue = uniqid();

            // TODO - Save the cookie value to the database of package 
            // Set the cookie with a name 'user_cookie' and the generated value
            Cookie::queue('user_cookie', $cookieValue, 60); // 60 is the number of minutes the cookie will be valid
        }

        // Continue with the request
        return $next($request);              
    }
}
