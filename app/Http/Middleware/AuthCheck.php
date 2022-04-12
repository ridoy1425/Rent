<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();

        if($path=="login" && Session()->has('loginId'))
        {
            return redirect('/')->with('success','you are already loged in');
        }
        else if($path!="login" && !Session()->has('loginId'))
        {
            return redirect('login')->with('error','Please login first');
        }
        return $next($request);
    }
}
