<?php

namespace Modules\Hr\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessAssigner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!getLoggedInEmployee()->hasRole('admin')){
            return formatAsJson('Unauthorised action!',false,[],Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
