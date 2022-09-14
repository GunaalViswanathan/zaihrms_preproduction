<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Models\UserProfile;

use LaraSnap\LaravelAdmin\Models\Category;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class EmployeeController extends Controller
{
    private $userService;
    use \LaraSnap\LaravelAdmin\Traits\Role;

    public function __construct(EmployeeService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $role = Role::whereIn('name', ['admin', 'super-admin'])->pluck('id')->toArray();

        $userFilter = User::whereHas('user_role', function ($query) use ($role) {
            $query->whereIn('role_id', $role);
        })->get();
        $filter_request = $this->userService->filterValue($request); //filter request
        $users          = $this->userService->index($filter_request);
        // dd($users);

        return view('admin.employee.index')->with(['users' => $users, 'filters' => $filter_request, 'userFilter' => $userFilter]);
    }

    public function index1(Request $request)
    {
        // dd($request->all());
       
        // dd($users);

        return view('admin.employee.index1');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $role = Role::whereIn('name', ['admin', 'super-admin'])->pluck('id')->toArray();

        $categories = Category::where('name', 'team')->first();




        // $primaryReporter = UserProfile::where('primary_reporter',1)->select('user_id','first_name','last_name')->get();
        //   dd($primaryReporter);
        // $categories->childCategory()->pluck('id')->toArray();
        $employee = $categories->childCategory()->pluck('id')->toArray();
        $teamEmployee = UserProfile::whereIn('team ', ['php', 'python', 'qa']);
        //  dd($teamEmployee);

        // dd($categories);
        $filter_request = $this->userService->filterValue($request);
        $emp    = $this->userService->index($filter_request);

        $users = User::whereHas('user_role', function ($query) use ($role) {
            $query->whereIn('role_id', $role);
        })->get();


        // $emp = Userprofiles::table("userprofiles")
        //     ->whereColumn('primery_reporter','>','team')
        //     ->get();

        return view('admin.employee.create', compact('users', 'categories', 'emp','teamEmployee'));
    }

    public function getJunoiorEmployee(Request $request)
    {


        $juniorEmployee = UserProfile::where('team', $request->team_id)
            ->where('primary_reporter', 0)->select('user_id', 'first_name', 'last_name')->get()->toArray();
        // dd($juniorEmployee);
        return ['juniors' => $juniorEmployee];
    }
    // public function getPrimaryReport(Request $request)
    // {
    //     $role = Role::whereIn('name', ['admin', 'super-admin'])->pluck('id')->toArray();

    //     $teamId=$request->team_id;
    //     $PrimaryReport = User::with(['userProfile'])->whereHas('userProfile', function ($query) use ($role,$teamId) {
    //         $query->where('team',$teamId);
    //         $query->where('primary_reporter', 1)->select('user_id', 'first_name', 'last_name')
    //         ->whereHas('user_role', function ($Subquery) use ($role) {
    //             $Subquery->where('role_id', $role);
    //         });
    //     });

    // ->where('team', $request->team_id)
    //     ->where('primary_reporter', 1)->select('user_id', 'first_name', 'last_name')->get()->toArray();


    //     return response()->json(['staus' => "success", "reporter" => $PrimaryReport]);
    // }


    public function getPrimaryReport(Request $request)
    {

        $PrimaryReport_first = UserProfile::where('team', $request->team_id)
            ->where('primary_reporter', 1)->select('user_id', 'first_name', 'last_name')->get()->toArray();

        $admin_super_list = UserProfile::leftjoin('role_user', "role_user.user_id", '=', 'userprofiles.user_id')->whereIn('role_user.role_id', ['1', '2'])->select('userprofiles.user_id', 'first_name', 'last_name')->get()->toArray();

        $PrimaryReport = array_merge($PrimaryReport_first, $admin_super_list);
        // dd($PrimaryReport);
        $role = Role::whereIn('name', ['admin', 'super-admin'])->pluck('id')->toArray();

        $users = User::whereHas('user_role', function ($query) use ($role) {
            $query->whereIn('role_id', $role);
        })->get();
        // dd($PrimaryReport);
        return response()->json(['staus' => "success", "reporter" => $PrimaryReport]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $role = Role::where('name', 'employee')->pluck('id')->first();
        $user = $this->userService->store($request);
        $user = User::find($user->id);
        $user->assignRole($role);
        $user->status = $request->status;
        $user->save();

        return redirect()->route('employee.index')->withSuccess('Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('employee.index')->withError('Employee not found by ID ' . $id);
        }
        return view('admin.employee.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $role = Role::where('name', 'admin')->pluck('id')->first();
            $users = User::whereHas('user_role', function ($query) use ($role) {
                $query->where('role_id', '=', $role);
            })->get();
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('employee.index')->withError('Employee not found by ID ' . $id);
        }
        return view('admin.employee.edit')->with(['user' => $user, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $this->userService->update($request, $id, $user);
            $user->status = $request->status;
            $user->save();

            $listPageURL = getPreviousListPageURL('sweepstake_users') ?? route('employee.index');

            return redirect($listPageURL)->withSuccess('Employee successfully updated.');
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('employee.index')->withError('Employee not found by ID ' . $id);
        }
    }
    public function EmployeeEdit(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $role = Role::whereIn('name', ['admin', 'super-admin'])->pluck('id')->toArray();
            $users = User::whereHas('user_role', function ($query) use ($role) {
                $query->whereIn('role_id', $role);
            })->get();
            $categories = Category::where('name', 'team')->first();
            // dd($categories);
            $employee = $categories->childCategory()->pluck('id')->toArray();
            $teamEmployee = UserProfile::whereIn('team ', ['php', 'python', 'qa']);
            $filter_request = $this->userService->filterValue($request);
            $emp    = $this->userService->index($filter_request);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('employee.index')->withError('Employee not found by ID ' . $id);
        }
        return view('admin.employee.employee_edit')->with(['user' => $user, 'users' => $users, 'categories' => $categories, 'emp' => $emp]);
    }


    public function EmployeeUpdate(Request $request, $id)
    {
        $request->validate([
            'email' => 'required',
            'reporting_to' => 'required',
        ]);
        $user = User::find($id);
        $user->email = $request->email;
        $user->reporting_to = $request->reporting_to;
        $user->status = $request->status;
        $user->update();

        $user = UserProfile::find($id);
        $userId = $user->id;
        $user->team = $request->team;
        $user->primary_reporter = $request->primary_reporter;
        if ($request->primary_reporter == "1") {
            $employeecheckbox = $request->input('employeecheckbox');
            // dd($request->all());
            foreach ($employeecheckbox as $key => $value) {
                $reporting_to = User::find($value);
                $reporting_to->reporting_to = $userId;
                $reporting_to->update();
            }
        }

        return redirect()->route('employee.index')->withSuccess('Employee successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $this->userService->destroy($id, $user);
            return redirect()->route('employee.index')->withSuccess('Employee successfully deleted.');
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('employee.index')->withError('Employee not found by ID ' . $id);
        }
    }

    /**
     * Remove multiple user from storage.
     *
     */
    public function bulkdestroy(Request $request)
    {
        $idsToDelete = $request->records;
        if (count($idsToDelete) > 0) {
            $this->userService->bulkDelete($idsToDelete);
            return redirect()->route('employee.index')->withSuccess('Selected Employees successfully deleted.');
        }
    }

    public function employeeExport(Request $request)
    {
        return Excel::download(new EmployeeExport($request->all()), 'employee.xlsx');
    }

    public function getemployee(Request $request)
    {
        $input = $request->input;
        $role = Role::where('name', 'employee')->first();
        $employees = User::whereHas('user_role', function ($query) use ($role) {
            $query->where('role_id', $role->id);
        })->whereHas('userProfile', function ($query) use ($input) {
            $query->whereRaw("(first_name like '%" . $input . "%' OR last_name like '%" . $input . "%' OR email like '%" . $input . "%' OR mobile_no like '%" . $input . "%')");
        })->select('*')->get();
        if (!$employees->isEmpty()) {
            $output = '<ul class="list-unstyled">';
            foreach ($employees as $employee) {
                $output .= '<li data-id="' . $employee->id . '" data-value="' . $employee->email . '">' . $employee->email . '(' . $employee->full_name . ')' . '</li>';
            }
            $output .= '</ul>';
            echo $output;
            // return response()->json(['data'=> $output ]);
        }
    }
}
