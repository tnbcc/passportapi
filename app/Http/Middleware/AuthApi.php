<?php

namespace App\Http\Middleware;

use Closure;

class AuthApi
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
        if (auth()->guard('api')->guest()) {
            $msg = '需要授权';
            return response()->json(['success' => false, 'message' => $msg, 'status_code' => 401], 200);
        }
         return $next($request);
    }
}
