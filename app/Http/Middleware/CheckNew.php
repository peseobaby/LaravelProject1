<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckNew
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
        $checked = 1;
        if (Auth::user()->new == $checked) {
            return $next($request);
        } else {
            return redirect()->route('changepassword', ['id' => Auth::user()->id]);
        }
    }
}
