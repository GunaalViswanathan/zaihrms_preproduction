<?php

namespace App\Services;

use App\Filters\AnnouncementFilters;
use App\Models\Announcement;
use File;
use Illuminate\Support\Facades\Auth;
use LaraSnap\LaravelAdmin\Traits\Upload;
use LaraSnap\LaravelAdmin\Models\UserProfile;

class AnnouncementServices{

	use Upload;

    private $filters;

    /**
     * Injecting UserFilters.
     */
    public function __construct(AnnouncementFilters $filters)
    {
        $this->filters = $filters;
    }

	public function index($filter_request){
		$entriesPerPage = setting('entries_per_page');
        $users =Announcement::filter($this->filters, $filter_request)->orderBy('id','Desc')->paginate($entriesPerPage);
		return $users;
	}

	// return filter request values
	public function filterValue($request){
		/*filter-array keys should be same as the filter-field name*/

		/*Declare filter variables*/
        $filters['sort_by']     = config('larasnap.module_list.user.sort_by')[0]['value'];
        $filters['search']      = null;

		/*If filter has values or if user accessing page via pagination, show filter values*/
		if($request->page || $request->sort_by || $request->search){
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
            session(['announcement_' . $filter_type => $data]);
        }elseif($request->has($filter_type) && $request->{$filter_type} == '' ){
            session(['announcement_' . $filter_type => '']);
            $data = $filters[$filter_type];
        }elseif(session('announcement_'.$filter_type)){
			$data = session('announcement_'.$filter_type);
		}else{
			$data = $filters[$filter_type];
		}

		return $data;
	}

	public function deleteFilterSessionData($request, $filter_key){
            $request->session()->forget('announcement_'.$filter_key);
    }

	public function store($request){
        $data['title']=$request->title;
        $data['description']=$request->description;
        $announcement=Announcement::create($data);
		return $announcement;
	}

    public function update($request, $id, $announcement){
	   $data['title']=$request->title;
	   $data['description']=$request->description;
        $announcement->update($data);

        return $announcement;
    }

    public function destroy($id, $announcement){
        if ($announcement->filename) {
            $folder = config('larasnap.uploads.user.path');
            File::delete(storage_path() .'/app/' .$folder .'/'. $announcement->filename);
        }
        $announcement = $announcement->delete();

        return $announcement;
    }

	public function bulkDelete($idsToDelete){
	    $selectedAnnouncement = Announcement::whereIn('id', $idsToDelete)->get();
	    $imgArray = [];
	    foreach ($selectedAnnouncement as $announcement){
            if ($announcement->filename) {
                $folder = config('larasnap.uploads.user.path');
                $img = storage_path() .'/app/' .$folder .'/'. $announcement->filename;
                array_push($imgArray, $img);
            }
        }
        File::delete($imgArray);

	    $announcements = Announcement::whereIn('id', $idsToDelete)->delete();

	    return $announcements;
    }

}
