<?php

namespace App\Services;

use App\Filters\UsersFilters;
use App\Mail\CreateUser;
use App\Mail\Leave;
use App\Models\PrimaryReporter;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Traits\Upload;
use LaraSnap\LaravelAdmin\Models\UserProfile;

class UsersService{

	use Upload;

    private $filters;

    /**
     * Injecting UserFilters.
     */
    public function __construct(UsersFilters $filters)
    {
        $this->filters = $filters;
    }

	public function index($filter_request){
		$entriesPerPage = setting('entries_per_page');

        $role  = Role::where('name', 'employee')->first();

        $users = User::filter($this->filters, $filter_request)
            ->whereHas('user_role', function ($query) use ($role){
                $query->where('role_id', '!=', $role->id);
            })->whereHas('userProfile', function ($query) use ($filter_request){ $query->whereRaw("(first_name like '%".$filter_request['search']."%' OR last_name like '%".$filter_request['search']."%' OR email like '%".$filter_request['search']."%' OR mobile_no like '%".$filter_request['search']."%')"); })
            ->paginate($entriesPerPage);

		return $users;
	}

	// return filter request values
	public function filterValue($request){
		/*filter-array keys should be same as the filter-field name*/

		/*Declare filter variables*/
        $filters['sort_by']     = config('larasnap.module_list.user.sort_by')[0]['value'];
        $filters['user_role']   = 'all';
        $filters['user_status'] = 'all';
        $filters['search']      = null;

		/*If filter has values or if user accessing page via pagination, show filter values*/
		if($request->page || $request->sort_by || $request->user_role || $request->user_status || $request->search){
		    foreach($filters as $filter_key => $filter_def_value) {
                $filters[$filter_key] = $this->filterValueData($request, $filters, $filter_key);
            }
		}else{
		    //flush session values when accessing the page first time.
            foreach($filters as $filter_key => $filter_def_value) {
                $this->deleteFilterSessionData($request, $filter_key);
            }
        }
		return $filters;
	}

	/**
    * @param  request, filter default value, filter field name.
	**/
	public function filterValueData($request, $filters, $filter_type){
	    //check if request is present and not null
        //check if request is present and null - used on 'search'
        //session has value
        //default value
		if($request->filled($filter_type)) {
            $data = $request->{$filter_type};
            session(['user_' . $filter_type => $data]);
        }elseif($request->has($filter_type) && $request->{$filter_type} == '' ){
            session(['user_' . $filter_type => '']);
            $data = $filters[$filter_type];
        }elseif(session('user_'.$filter_type)){
			$data = session('user_'.$filter_type);
		}else{
			$data = $filters[$filter_type];
		}

		return $data;
	}

	public function deleteFilterSessionData($request, $filter_key){
            $request->session()->forget('user_'.$filter_key);
    }

	public function store($request){
        
		$data = $request->except('password');
        $data['password']   = bcrypt($request->password);
        $data['created_by'] = Auth::id();
        $data['reporting_to']  = 1;
        
        // dd($data);

        $user   = User::create($data);
		$userId = $user->id;
		$data['mobile_no'] = $request->mobile_number;
		$userProfile   = $user->userProfile()->create($data);
		$userProfileId = $userProfile->id;

		/* handle if image uploaded*/
		 if ($request->has('user_photo')) {
			$image = $request->file('user_photo');
			$folder = config('larasnap.uploads.user.path');

			$imgName = $this->upload($image, $folder, 'user', $userId);

			$userProfile  = Userprofile::find($userProfileId);
			$userProfile->date_of_joining = $request->date_of_joining;
            $userProfile->user_photo  = $imgName;

            
           


            $userProfile->save();
		 }

         $mail = explode(',', setting('admin_notification'));
		 Mail::to($user->email)->cc($mail)->send(new CreateUser($user, $request->password));
		 return $user;
	}

    public function update($request, $id, $user, $type = null){
	    /* handle if password updated*/
        if ($request->filled('password')) {
           $userData['password'] = bcrypt($request->password);
        }
        $userData['email'] = $request->email;
        if(is_null($type)){
            $userData['status'] = $request->status;
        }
        $userData['reporting_to']  = 1;
	    $user->update($userData);

        /* handle if image uploaded*/
        if ($request->has('user_photo')) {
           $image = $request->file('user_photo');
           $folder = config('larasnap.uploads.user.path');
           if ($user->userProfile && $user->userProfile->user_photo) {
               File::delete(storage_path() .'/app/' .$folder .'/'. $user->userProfile->user_photo);
           }
           $imgName = $this->upload($image, $folder, 'user', $id);
           $userProfileData['user_photo'] = $imgName;
        }

        $userProfile = Userprofile::where('user_id', $id)->first();

        $userProfileData['first_name'] = $request->first_name;
        $userProfileData['last_name']  = $request->last_name;
        $userProfileData['personal_email']  = $request->personal_email;
        $userProfileData['mobile_no']  = $request->mobile_no;
        $userProfileData['date_of_joining'] = $request->date_of_joining;

        if($userProfile){
            $user->userProfile()->update($userProfileData);
        }else{
            //If user is registered from frontend, on edit newly the user profile details.
            $userProfileData['user_id']    = $id;
            $user = Userprofile::create($userProfileData);
        }

        return $user;
    }

    public function destroy($id, $user){
        if ($user->userProfile && $user->userProfile->user_photo) {
            $folder = config('larasnap.uploads.user.path');
            File::delete(storage_path() .'/app/' .$folder .'/'. $user->userProfile->user_photo);
        }
        $user = $user->delete();

        return $user;
    }

	public function bulkDelete($idsToDelete){
	    $selectedUsers = User::whereIn('id', $idsToDelete)->get();
	    $imgArray = [];
	    foreach ($selectedUsers as $user){
            if ($user->userProfile && $user->userProfile->user_photo) {
                $folder = config('larasnap.uploads.user.path');
                $img = storage_path() .'/app/' .$folder .'/'. $user->userProfile->user_photo;
                array_push($imgArray, $img);
            }
        }
        File::delete($imgArray);

	    $users = User::whereIn('id', $idsToDelete)->delete();

	    return $users;
    }

}
