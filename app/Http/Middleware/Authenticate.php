<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        if (! $request->expectsJson()) {
            if($request->segment(1)  == "admin"){
                return route($request->segment(1) . '.login');
            }
      
            return route( 'login');

        }
    }
}
