<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;
class CheckKey
{

    public function handle($request, Closure $next) {

        $token = $request->header('token');
        $access =config('app.accessToken');


        //This will be excecuted if the new authentication fails.
      	if ($token != $access)
        {
          return response()->json(['status' => 0,'message' => 'unauthorize']);
        }

       return $next($request);
    }

}
