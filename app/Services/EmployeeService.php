<?php

namespace App\Services;

use App\Filters\EmployeeFilter;
use App\Mail\CreateUser;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\PrimaryReporter;
use App\Models\User;
use App\Models\UserFamily;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Traits\Upload;
use LaraSnap\LaravelAdmin\Models\UserProfile;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{

    use Upload;

    private $filters;

    /**
     * Injecting UserFilters.
     */
    public function __construct(EmployeeFilter $filters)
    {
        $this->filters = $filters;
    }

    public function index($filter_request)
    {
        $entriesPerPage = setting('entries_per_page');

        //filter($filters) - pass only 2nd argument, 1st argument will be automatically injected to dynamic scope.  $filters - Needs to be a child class of \LaraSnap\LaravelAdmin\Filters\Filters
        $role  = Role::where('name', 'employee')->first();
        $users = User::whereHas('user_role', function ($query) use ($role) {
            $query->where('role_id', $role->id);
        })->whereHas('userProfile', function ($query) use ($filter_request) {
            $query->whereRaw("(first_name like '%" . $filter_request['search'] . "%' OR last_name like '%" . $filter_request['search'] . "%' OR email like '%" . $filter_request['search'] . "%' OR mobile_no like '%" . $filter_request['search'] . "%')");
        });
        /*Reporting To*/
        if ($filter_request['reporting_to'] != '') {
            $users->where('reporting_to', $filter_request['reporting_to']);
        }
        /*Sort by*/
        if ($filter_request['sort_by'] != '') {
            if ($filter_request['sort_by'] == 'latestfirst') {
                $users->orderByDesc('id');
            }
        } else {
            $users->orderby('id', 'asc');
        }
        /*Status*/
        if ($filter_request['user_status'] != 'all') {
            $users->where('status', '=', $filter_request['user_status']);
        }

        return $users->paginate($entriesPerPage);
    }

    // return filter request values
    public function filterValue($request)
    {
        /*filter-array keys should be same as the filter-field name*/

        /*Declare filter variables*/
        $filters['sort_by']     = config('larasnap.module_list.user.sort_by')[0]['value'];
        $filters['user_status'] = 'all';
        $filters['search']      = null;
        $filters['reporting_to'] = null;

        /*If filter has values or if user accessing page via pagination, show filter values*/
        if ($request->page || $request->sort_by || $request->user_status || $request->search || $request->reporting_to) {
            foreach ($filters as $filter_key => $filter_def_value) {
                $filters[$filter_key] = $this->filterValueData($request, $filters, $filter_key);
            }
        } else {
            //flush session values when accessing the page first time.
            foreach ($filters as $filter_key => $filter_def_value) {
                $this->deleteFilterSessionData($request, $filter_key);
            }
        }
        return $filters;
    }

    /**
     * @param  request, filter default value, filter field name.
     **/
    public function filterValueData($request, $filters, $filter_type)
    {
        //check if request is present and not null
        //check if request is present and null - used on 'search'
        //session has value
        //default value
        if ($request->filled($filter_type)) {
            $data = $request->{$filter_type};
            session(['stake_user_' . $filter_type => $data]);
        } elseif ($request->has($filter_type) && $request->{$filter_type} == '') {
            session(['stake_user_' . $filter_type => '']);
            $data = $filters[$filter_type];
        } elseif (session('stake_user_' . $filter_type)) {
            $data = session('stake_user_' . $filter_type);
        } else {
            $data = $filters[$filter_type];
        }

        return $data;
    }

    public function deleteFilterSessionData($request, $filter_key)
    {
        $request->session()->forget('stake_user_' . $filter_key);
    }

    public function store($request)
    {
        $data = $request->except('password');
        $data['password']   = bcrypt($request->password);
        $data['reporting_to']   = $request->reporting_to;
        $data['created_by'] = Auth::id();

        $user   = User::create($data);

        $userId = $user->id;
        $userProfileData['first_name'] = $request->first_name;
        $userProfileData['last_name'] = $request->last_name;
        $userProfileData['personal_email']  = $request->personal_email;
        $userProfileData['mobile_no']  = $request->mobile_number;
        $userProfileData['date_of_joining']  = $request->date_of_joining;

        $userProfile   = $user->userProfile()->create($userProfileData);

        $userProfile->team = $request->team;
        $userProfile->primary_reporter = $request->primary_reporter;
// dd($request->primary_reporter);
        if($request->primary_reporter =="1" ) {
            $employeecheckbox = $request->input('employeecheckbox');
            foreach ($employeecheckbox as $key => $value)  {
                $reporting_to = User::find($value);
                $reporting_to->reporting_to = $userId;
                $reporting_to->update();

                
            }
        }
       
        // dd($reporting_to);



        // dd($employeecheckbox);

        // dd($UserProfile);

        $userProfile->save();

        $userProfileId = $userProfile->id;

        /* handle if image uploaded*/
        if ($request->has('user_photo')) {
            $image = $request->file('user_photo');
            $folder = config('larasnap.uploads.user.path');

            $imgName = $this->upload($image, $folder, 'user', $userId);

            $userProfile  = Userprofile::find($userProfileId);
            $userProfile->user_photo  = $imgName;
            $userProfile->save();
        }
        $mail = explode(',', setting('admin_notification'));
        array_push($mail, reportingEmail($user->reporting_to));
        Mail::to($user->email)->cc($mail)->send(new CreateUser($user, $request->password));
        return $user;
    }

    public function update($request, $id, $user, $type = null)
    {
        /* handle if password updated*/
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }
        $userData['email'] = $request->email;
        if (is_null($type)) {
            $userData['status'] = $request->status;
        }
        $userData['reporting_to'] = $request->reporting_to;
        $user->update($userData);

        /* handle if image uploaded*/
        if ($request->has('user_photo')) {
            $image = $request->file('user_photo');
            $folder = config('larasnap.uploads.user.path');
            if ($user->userProfile && $user->userProfile->user_photo) {
                File::delete(storage_path() . '/app/' . $folder . '/' . $user->userProfile->user_photo);
            }
            $imgName = $this->upload($image, $folder, 'user', $id);
            $userProfileData['user_photo'] = $imgName;
        }

        $userProfile = Userprofile::where('user_id', $id)->first();
        $userProfileData['first_name'] = $request->first_name;
        $userProfileData['last_name']  = $request->last_name;
        $userProfileData['personal_email']  = $request->personal_email;
        $userProfileData['mobile_no']  = $request->mobile_no;
        $userProfileData['alternate_mobile_number']  = $request->alternate_mobile_number;
        $userProfileData['dob']  = $request->dob;
        $userProfileData['permanent_address']  = $request->permanent_address;
        $userProfileData['residential_address']  = $request->residential_address;
        $userProfileData['same_address']  = $request->same_address;
        $userProfileData['blood_group']  = $request->blood_group;
        $userProfileData['pan_number']  = $request->pan_number;
        $userProfileData['aadhar_number']  = $request->aadhar_number;
        $userProfileData['bank_name']  = $request->bank_name;
        $userProfileData['account_number']  = $request->account_number;
        $userProfileData['ifsc_code']  = $request->ifsc_code;
        $userProfileData['holder_name']  = $request->account_holder_name;
        $userProfileData['date_of_joining'] = $request->date_of_joining;
        if ($userProfile) {
            $user->userProfile()->update($userProfileData);
        } else {
            //If user is registered from frontend, on edit newly the user profile details.
            $userProfileData['user_id']    = $id;
            $user = Userprofile::create($userProfileData);
        }

        $userFamily = UserFamily::where('user_id', $id)->first();
        $userFamilyData['father_name'] = $request->father_name;
        $userFamilyData['mother_name']  = $request->mother_name;
        $userFamilyData['marital_status']  = $request->marital_status;
        $userFamilyData['date_of_married']  = $request->date_of_married;
        $userFamilyData['spouse_name']  = $request->spouse_name;
        $userFamilyData['no_of_children']  = $request->no_of_children;

        if ($userFamily) {
            $user->userFamily()->update($userFamilyData);
        } else {
            //If user is registered from frontend, on edit newly the user profile details.
            $userFamilyData['user_id']    = $id;
            $user = UserFamily::create($userFamilyData);
        }


        return $user;
    }

    public function sendMailNotification($email_template, $entry, $action)
    {
        $userProfile = Userprofile::where('user_id', $entry->id)->first();
        $subject = $email_template->subject;
        if (Str::contains($email_template->subject, ['[status]', '{status}'])) {
            $subject = str_replace(['[status]', '{status}'], $action, $subject);
        }
        if (Str::contains($email_template->subject, ['[user]', '{user}'])) {
            $subject = str_replace(['[user]', '{user}'], $entry->name, $subject);
        }

        $data['email_message'] = $email_template->email_message;
        if (Str::contains($email_template->email_message, ['[status]', '{status}'])) {
            $data['email_message'] = str_replace(['[status]', '{status}'], $action, $data['email_message']);
        }
        if (Str::contains($email_template->email_message, ['[user]', '{user}'])) {
            $data['email_message'] = str_replace(['[user]', '{user}'], $userProfile->first_name, $data['email_message']);
        }
        $data['title'] = $action . ' Notification';
        $user_email    = [$entry->email];

        Mail::send('emails.email_template', ['data' => $data], function ($message) use ($user_email, $subject) {
            $message->subject($subject);
            $message->to($user_email);
        });

        return 'send';
    }

    public function destroy($id, $user)
    {
        if ($user->userProfile && $user->userProfile->user_photo) {
            $folder = config('larasnap.uploads.user.path');
            File::delete(storage_path() . '/app/' . $folder . '/' . $user->userProfile->user_photo);
        }
        User::where('id', $user->id)->delete();
        $user = $user->delete();

        return $user;
    }

    public function bulkDelete($idsToDelete)
    {
        $selectedUsers = User::whereIn('id', $idsToDelete)->get();
        $imgArray = [];
        foreach ($selectedUsers as $user) {
            if ($user->userProfile && $user->userProfile->user_photo) {
                $folder = config('larasnap.uploads.user.path');
                $img = storage_path() . '/app/' . $folder . '/' . $user->userProfile->user_photo;
                array_push($imgArray, $img);
            }
        }
        File::delete($imgArray);
        Employee::whereIn('user_id', $idsToDelete)->delete();
        $users = User::whereIn('id', $idsToDelete)->delete();

        return $users;
    }
}
