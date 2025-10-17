<?php

namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class UserMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     * 
     */

    protected function redirectTo($request){

        return route('user.login');
    }
}
