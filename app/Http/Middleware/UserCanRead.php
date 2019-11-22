<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCanRead
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
        $segment1 = $request->segment(1);
        if (Auth::user()->outlet_id !== null) {
            return $next($request);
        } else {
            return redirect('/newuser');
        }
    }
}
