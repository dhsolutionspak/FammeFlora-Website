<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;
class CustomerAuth
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(Auth::guard('customer')->check()) {
            return $next($request);
        }

        return redirect()->back()->with('commonError','Login Required');
    }


    public function handle($request, Closure $next) {

      	$isAuthenticated = (Auth::guard('customer')->check());
      	//This will be excecuted if the new authentication fails.
      	if (!$isAuthenticated)
        {
          return redirect()->back()->with('commonError','Login Required');
        }

       return $next($request);
    }

}
