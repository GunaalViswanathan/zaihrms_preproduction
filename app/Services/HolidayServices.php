<?php

namespace App\Services;

use App\Filters\HolidayFilters;
use App\Models\Holidays;
use File;
use Illuminate\Support\Facades\Auth;
use LaraSnap\LaravelAdmin\Traits\Upload;
use LaraSnap\LaravelAdmin\Models\UserProfile;
use Carbon\Carbon;

class HolidayServices{

	use Upload;

    private $filters;

    /**
     * Injecting UserFilters.
     */
    public function __construct(HolidayFilters $filters)
    {
        $this->filters = $filters;
    }

	public function index($filter_request){
		$entriesPerPage = 15;
        $users =Holidays::filter($this->filters, $filter_request)->paginate($entriesPerPage);
		return $users;
	}

	// return filter request values
	public function filterValue($request){
		/*filter-array keys should be same as the filter-field name*/
		/*Declare filter variables*/
        $filters['sort_by']     = config('larasnap.module_list.user.sort_by')[1]['value'];
        $filters['holiday']     = null;
        $filters['search']      = null;

		/*If filter has values or if user accessing page via pagination, show filter values*/
		if($request->page || $request->sort_by || $request->search || $request->holiday){
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
            session(['holiday_' . $filter_type => $data]);
        }elseif($request->has($filter_type) && $request->{$filter_type} == '' ){
            session(['holiday_' . $filter_type => '']);
            $data = $filters[$filter_type];
        }elseif(session('holiday_'.$filter_type)){
			$data = session('holiday_'.$filter_type);
		}else{
			$data = $filters[$filter_type];
		}

		return $data;
	}

	public function deleteFilterSessionData($request, $filter_key){
            $request->session()->forget('holiday_'.$filter_key);
    }

	public function store($request){
        $data['holiday_name']=$request->holiday_name;
        $data['holiday_date']=$request->holiday_date;
        $holiday=Holidays::create($data);
		return $holiday;
	}

    public function update($request, $id, $holiday){
	   $data['holiday_name']=$request->holiday_name;
	   $data['holiday_date']=$request->holiday_date;
       $data['updated_at'] = Carbon::yesterday();
        $holiday->update($data);

        return $holiday;
    }

    public function destroy($id, $holiday){

        $holiday = $holiday->delete();
        return $holiday;
    }

	public function bulkDelete($idsToDelete){
	    $holiday = Holidays::whereIn('id', $idsToDelete)->delete();
	    return $holiday;
    }

}
