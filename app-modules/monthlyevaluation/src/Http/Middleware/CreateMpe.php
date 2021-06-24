<?php

namespace Modules\Monthlyevaluation\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CreateMpe
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
        /*
        criteria => 
            1. Must be supervisor, or Hr 
            2. Should have permission to Assign MPE
            3.dept should match(hr can assign to supervisors)
        */
        if(!(getLoggedInEmployee()->hasRole(['admin','hr','supervisor'])) || !(getLoggedInEmployee()->can(['perform appraisal']))){
           return formatAsJson('This user is not authorised to create MPE',false,[],401);
        }
        return $next($request);
    }
}
