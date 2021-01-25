<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAge
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
        // login middleware he mean logic
        $age = Auth::user() -> age; //by this he take all user with their age this Auth::user() -> age;
        if($age < 15) {
             return redirect() -> route('not.adult');
        }
        return $next($request);
    }
}
