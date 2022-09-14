<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\User;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Models\Screen;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $role  = Role::where('name', 'employee')->first();
        setCurrentListPageURL('dashboard');
        $usersActiveCount   = \App\Models\User::whereHas('user_role', function ($query) use ($role){
                $query->where('role_id',$role->id);
            })->where('status', 1)->count();
        $usersInactiveCount = \App\Models\User::whereHas('user_role', function ($query) use ($role){
            $query->where('role_id',$role->id);
        })->where('status', 0)->count();
        $rolesCount         = Role::count();
        $screensCount       = Screen::count();

        return view('larasnap::dashboard')->with(['usersActiveCount' => $usersActiveCount, 'usersInactiveCount' => $usersInactiveCount, 'rolesCount' => $rolesCount, 'screensCount' => $screensCount]);
    }
}
