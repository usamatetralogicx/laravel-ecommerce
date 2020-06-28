<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminAuthentication
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
        if(Auth::user()->email=='costumer@gmail.com')
        {
            return redirect('/home');
        }
        return $next($request);
    }
}
