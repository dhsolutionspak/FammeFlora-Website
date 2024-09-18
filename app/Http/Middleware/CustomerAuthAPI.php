<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;
class CustomerAuthAPI
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(Auth::guard('api')->check()) {
            return $next($request);
        }

        return response()->json(['status' => 0,'message' => 'unauthorize']);
    }


    public function handle($request, Closure $next) {

      	$isAuthenticated = (Auth::guard('api')->check());
      	//This will be excecuted if the new authentication fails.
      	if (!$isAuthenticated)
        {
          return response()->json(['status' => 0,'message' => 'unauthorize']);
        }

       return $next($request);
    }

}
