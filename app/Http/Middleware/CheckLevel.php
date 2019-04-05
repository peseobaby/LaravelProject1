<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {   
        $admin = 1;
        if (Auth::user()->level_id == $admin) {
            return $next($request);
        } else {
            return redirect()->route('user.show', ['id' => Auth::user()->id]);
        }
    }
}
