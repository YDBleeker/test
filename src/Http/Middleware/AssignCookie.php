<?php

namespace Yonidebleeker\Webinsights\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Yonidebleeker\Webinsights\Webinsights;

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
        $cookie = "";
        if (!$request->cookie('user_cookie')) {
            $cookieValue = uniqid();
            // Set the cookie with a name 'user_cookie' and the generated value
            Cookie::queue('user_cookie', $cookieValue, 60); // 60 is the number of minutes the cookie will be valid

            $cookie = 'insights_user_cookie=' . $cookieValue;
            $request->headers->set('cookie', $cookie);
        }

        // Instantiate the Webinsights class
        $webinsights = new Webinsights();

        // Call the store method
        $webinsights->store();

        // Continue with the request
        return $next($request);
    }
}
