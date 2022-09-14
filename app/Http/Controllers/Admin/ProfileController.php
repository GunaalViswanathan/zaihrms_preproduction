<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\User;
use App\Models\UserEducation;
use App\Models\UserExperience;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\Role;
use App\Services\EmployeeService;
use Auth;
use Validator;

class ProfileController extends Controller
{
    private $userService;

    /**
     * Injecting UserService.
     */
    public function __construct(EmployeeService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('admin.employee.employeeshow', compact('user'));
    }

    public function updateProfile()
    {
        $user = Auth::user();

        return view('larasnap::profile', compact('user'));
    }

    /**
     * Update the user in storage.
     *
     * @param  UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
       
        $user = User::find($id);
        $this->userService->update($request, $id, $user, 'profile');
        $role  = loginUserRole(auth()->user()->id);

        /*$role = loginUserRole($id);
        if ($role == 'Admin') {
            return redirect()->route('users.edit', $id)->withSuccess('Admin details successfully updated.');
        } elseif ($role == 'Employee') {
            return redirect()->route('employee.edit', $id)->withSuccess('Employee details successfully updated.');
        }*/

        return redirect()->route('profile.edit')->withSuccess('Profile successfully updated.');
    }

    public function educationDetail(Request $request)
    {
        if ($request->operation == 'new_item') {
            $validator = Validator::make($request->all(), [
                'institute_name' => 'required|max:100|min:2',
                'qualification' => 'required|max:100|min:2',
                'passing_year' => 'required',
                'percentage_score' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => validateErrorObj($validator->errors()->getMessages())]);
            }
            $userEduData['user_id'] = $request->user_id;
            $userEduData['institute_name'] = $request->institute_name;
            $userEduData['qualification'] = $request->qualification;
            $userEduData['passing_year'] = $request->passing_year;
            $userEduData['percentage_score'] = $request->percentage_score;
            UserEducation::create($userEduData);
            return response()->json(['success' => 'Education Details Added']);
        }
        if ($request->operation == 'edit') {
            $userEducation = UserEducation::where('id', $request->id)->first();
            return response()->json(['edit_details' => $userEducation]);
        }
        if ($request->operation == 'edit_item') {
            $validator = Validator::make($request->all(), [
                'institute_name' => 'required|max:100|min:2',
                'qualification' => 'required|max:100|min:2',
                'passing_year' => 'required',
                'percentage_score' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => validateErrorObj($validator->errors()->getMessages())]);
            }
            $userEduData['user_id'] = $request->user_id;
            $userEduData['institute_name'] = $request->institute_name;
            $userEduData['qualification'] = $request->qualification;
            $userEduData['passing_year'] = $request->passing_year;
            $userEduData['percentage_score'] = $request->percentage_score;
            $userEducation = UserEducation::where('id', $request->id)->first();
            $userEducation->update($userEduData);
            return response()->json(['success' => 'Education Details Updated']);
        }
        if ($request->operation == 'delete_item') {
            $userEducation = UserEducation::where('id', $request->id)->delete();
            return response()->json(['success' => 'Education Details Deleted']);
        }
    }

    public function education(Request $request, $id)
    {
        $user = UserEducation::where('user_id', $id)->orderBy('passing_year', 'asc')->get();
        return view('admin.employee.education_list')->with(['user' => $user]);
    }

    public function experienceDetail(Request $request)
    {
        if ($request->operation == 'new_item') {
            $validator = Validator::make($request->all(), [
                'organization' => 'required|max:100|min:2',
                'designation' => 'required|max:100|min:2',
                'from_year' => 'required',
                'to_year' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => validateErrorObj($validator->errors()->getMessages())]);
            }
            $userExpData['user_id'] = $request->user_id;
            $userExpData['organization'] = $request->organization;
            $userExpData['designation'] = $request->designation;
            $userExpData['from_year'] = $request->from_year;
            $userExpData['to_year'] = $request->to_year;
            UserExperience::create($userExpData);
            return response()->json(['success' => 'Experience Details Added']);
        }
        if ($request->operation == 'edit') {
            $userEducation = UserExperience::where('id', $request->id)->first();
            return response()->json(['edit_details' => $userEducation]);
        }
        if ($request->operation == 'edit_item') {
            $validator = Validator::make($request->all(), [
                'organization' => 'required|max:100|min:2',
                'designation' => 'required|max:100|min:2',
                'from_year' => 'required',
                'to_year' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => validateErrorObj($validator->errors()->getMessages())]);
            }
            $userExpData['user_id'] = $request->user_id;
            $userExpData['organization'] = $request->organization;
            $userExpData['designation'] = $request->designation;
            $userExpData['from_year'] = $request->from_year;
            $userExpData['to_year'] = $request->to_year;
            $userEducation = UserExperience::where('id', $request->id)->first();
            $userEducation->update($userExpData);
            return response()->json(['success' => 'Experience Details Updated']);
        }
        if ($request->operation == 'delete_item') {
            $userEducation = UserExperience::where('id', $request->id)->delete();
            return response()->json(['success' => 'Experience Details Deleted']);
        }
    }

    public function experience(Request $request, $id)
    {
        $user = UserExperience::where('user_id', $id)->get();
        return view('admin.employee.experience_list')->with(['user' => $user]);
    }
}
