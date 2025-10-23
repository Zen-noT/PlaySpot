<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class StoreAuthMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     * 
     */

    protected function redirectTo($request){

        return route('store.login');
    }
    
    // protected function authenticate($request, array $guards){
        
    //     if (empty($guards)) {
    //         $guards = ['web'];
    //     }

    //     $this->auth->shouldUse($guards[0]);

    //     parent::authenticate($request, $guards);

    // }
    
}
