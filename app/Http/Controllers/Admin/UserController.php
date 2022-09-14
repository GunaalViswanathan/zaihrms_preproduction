<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\Role;
use Illuminate\Support\Facades\View;

use Mail;

class UserController extends Controller
{
    private $userService;
    use \LaraSnap\LaravelAdmin\Traits\Role;

    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        setCurrentListPageURL('users');
        $filter_request = $this->userService->filterValue($request); //filter request
        //$roles        = $this->getAllRoles();
        $roles          = $this->getAdminUserRoles();
        $users          = $this->userService->index($filter_request);

        return view('larasnap::users.index')->with(['users' => $users, 'roles' => $roles, 'filters' => $filter_request]);
    }

    public function create()
    {
        $roles = $this->getAdminUserRoles();
        return view('larasnap::users.create',compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $role = Role::where('name', 'admin')->pluck('id')->first();
        $user = $this->userService->store($request);
        $user = User::find($user->id);
        $user->assignRole($role);
        $user->status = $request->status;
        $user->save();

        return redirect()->route('users.index')->withSuccess('Admin created successfully.');
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $roles = $this->getAdminUserRoles();
            //If 'Super Admin Role' is added on the config & if the user has 'Super Admin Role', show the edit screen only if the logged in user has 'Super Admin Role'
            /* $superAdminRole = config('larasnap.superadmin_role');
             if(isset($superAdminRole) && !empty($superAdminRole) && $user->roles->contains('name', $superAdminRole) && !userHasRole($superAdminRole)){
                 return redirect()->route('users.index')->withError('Illegal Access: No permission to edit user by ID ' .$id);
             }*/
            if (auth()->user()->id == $id) {
                return view('admin.employee.edit', compact('user','roles'));
            } else {
                return abort(404);
            }
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('users.index')->withError('Admin not found by ID ' .$id);
        }

    }

    public function update(UserRequest $request, $id)
    {
        //$role  = Role::where('name', 'admin')->pluck('id')->first();
        try {
            $user = User::findOrFail($id);
            $this->userService->update($request, $id, $user);
            /*$user->roles()->detach();
            $user->assignRole($role);*/
            $user->status = $request->status;
            $user->save();

            $listPageURL = getPreviousListPageURL('users') ?? route('users.index');

            return redirect($listPageURL)->withSuccess('Admin successfully updated.');
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('users.index')->withError('Admin not found by ID ' .$id);
        }
    }

    public function getAdminUserRoles()
    {
        //$role  = Role::where('name', 'super-admin')->first();
        $role  = Role::where('name', 'admin')->first();
        if($role){
            $roles = Role::select('id', 'name', 'label')->where('id','!=',$role->id)->get();
            $roles = $roles->pluck('id', 'label');
        }else{
            $roles = [];
        }

        return $roles;
    }

    public function show($id) {
        try {
            $user = User::findOrFail($id);

        }catch (ModelNotFoundException $exception) {
            return redirect()->route('users.index')->withError('Admin not found by ID ' .$id);
        }
        return view('larasnap::users.show', compact('user'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $this->userService->destroy($id, $user);
            return redirect()->route('users.index')->withSuccess('Admin successfully deleted.');
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('users.index')->withError('Admin not found by ID ' .$id);
        }
    }

    public function bulkdestroy(Request $request){
        $idsToDelete = $request->records;
        if (count($idsToDelete)>0) {
            $this->userService->bulkDelete($idsToDelete);
            return redirect()->route('users.index')->withSuccess('Selected Users successfully deleted.');
        }
    }
    public function createPassword(){
        return view('change_password.password');
    }
    public function updatePassword(Request $request, $id){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);
        $data = $request->all();
        $user = User::find(auth()->user()->id);
        if (!Hash::check($data['old_password'], $user->password)) {
            return back()->with('error', 'The specified password does not match the database password');
        } else {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->withSuccess('Your password changed successfully');


    }
}
}
