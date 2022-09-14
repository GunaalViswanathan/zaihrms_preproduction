<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\Role;

class ManyRolesMiddleware
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$roles)
    {
        $user_role = Role::where('name', 'employee')->first();
        $roles = explode("|", $roles);
        foreach($roles as $role) {
            if(auth()->user()->user_role->role_id == $role) {
                return $next($request);
            }
        }
    }
}
