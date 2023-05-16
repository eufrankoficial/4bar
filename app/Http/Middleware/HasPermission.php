<?php

namespace App\Http\Middleware;

use Closure;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $param1, $param2 = null)
    {
        $hasPermission = current_user()->hasPermissionRoute($param1);

        if(!$hasPermission) {

            $hasPermission = current_user()->userHasPermission([$param1, $param2]);

            if(!$hasPermission) {
                return abort(403);
            }
        }


        return $next($request);
    }
}
