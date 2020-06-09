<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isDeletedMiddleware
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
        /**
         * Check is deleted is not null
         */
        if(Auth::user()->deleted_at != null)
        {
            Auth::logout();
        }
        return $next($request);
    }
}
