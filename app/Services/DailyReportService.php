<?php

namespace App\Services;

use App\Filters\DailyReportFilters;

use App\Models\Report;
use File;
use Illuminate\Support\Facades\Auth;
use LaraSnap\LaravelAdmin\Traits\Upload;
use LaraSnap\LaravelAdmin\Models\UserProfile;

class DailyReportService{

	use Upload;

    private $filters;

    /**
     * Injecting UserFilters.
     */
    public function __construct(DailyReportFilters $filters)
    {
        $this->filters = $filters;
    }

	public function index($filter_request){
        $entriesPerPage = setting('entries_per_page');
        $report =Report::filter($this->filters, $filter_request)->paginate($entriesPerPage);
        return $report;
	}

	// return filter request values
	public function filterValue($request){
		/*filter-array keys should be same as the filter-field name*/
		/*Declare filter variables*/
       
        $filters['sort_by']     = config('larasnap.module_list.user.sort_by')[0]['value'];
        $filters['project_name'] = 'all';
        $filters['resources'] = 'all';
        $filters['search']      = null;
        $filters['from_date'] = 'all';
        $filters['to_date'] = 'all';
        
        

		/*If filter has values or if user accessing page via pagination, show filter values*/
		if($request->page || $request->sort_by ||$request->project_name||$request->resources|| $request->search || $request->from_date || $request->to_date ){
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
            session(['report_' . $filter_type => $data]);
        }elseif($request->has($filter_type) && $request->{$filter_type} == '' ){
            session(['report_' . $filter_type => '']);
            $data = $filters[$filter_type];
        }elseif(session('report_'.$filter_type)){
			$data = session('report_'.$filter_type);
		}else{
			$data = $filters[$filter_type];
		}

		return $data;
	}

	public function deleteFilterSessionData($request, $filter_key){
            $request->session()->forget('report_'.$filter_key);
    }


}
