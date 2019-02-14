<?php

namespace App\Http\Middleware;

use Closure;

class AccessAuth
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
        if ($request->session()->get('login') != 1) {
            if ($request->ajax()){
                return response('Unauthorized', 401);
            }
            return redirect('/login');
        }
        return $next($request);
    }
}
