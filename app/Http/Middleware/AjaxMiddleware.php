<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Request;

class AjaxMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        if(!Request::ajax()){
            throw new Exception("Request must be an ajax");
        }

        return $next($request);
    }
}
