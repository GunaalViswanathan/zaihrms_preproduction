<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeavePolicy;
use App\Services\LeavePolicyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class LeavePolicyController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return View::make('admin.leave_policy.index');
    }

}
