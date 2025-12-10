<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        $user = Auth::guard('admin')->user();

        return $next($request);
       
        if($user->role == 3){
            return $next($request);
        }
        return redirect()->route('admin.login');
        
    }
}
