<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Modules\User\Entities\User;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $user = Auth::user();
        //if (!($user == 1)) {
            //if (!Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user does //not have this permission
            if ( !$user->id == 1 )
            {
                abort('401, you are not allowed to this page.');
            }
        //}
        return $next($request);
    }
}
