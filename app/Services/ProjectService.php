<?php

namespace App\Services;

use App\Filters\ProjectFilter;
use App\Models\Project;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class ProjectService{
    public $filter;
    public function __construct(ProjectFilter $filter){
        $this->filters = $filter;
    }

	public function index($filter_request){
        $entriesPerPage = setting('entries_per_page');
        $project =Project::filter($this->filters, $filter_request)->paginate($entriesPerPage);
		return $project;
    }
    public function filterValue($request){
		/*filter-array keys should be same as the filter-field name*/
		/*Declare filter variables*/
        $filters['sort_by']     = config('larasnap.module_list.user.sort_by')[0]['value'];
        $filters['project_type']     = 'all';
        $filters['project_status'] = 'all';
        $filters['search']      = '';
        $filters['search_project'] = null;
        $filters['userid'] = 'all';
        $filters['project_managing'] = 'all';
		/*If filter has values or if user accessing page via pagination, show filter values*/
		if($request->page || $request->sort_by || $request->project_type || $request->project_status || $request->search || $request->search_project || $request->project_managing){
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
    public function filterValueData($request, $filters, $filter_type){
	    //check if request is present and not null
        //check if request is present and null - used on 'search'
        //session has value
        //default value
		if($request->filled($filter_type)) {
            $data = $request->{$filter_type};
            session(['project_' . $filter_type => $data]);
        }elseif($request->has($filter_type) && $request->{$filter_type} == '' ){
            session(['project_' . $filter_type => '']);
            $data = $filters[$filter_type];
        }elseif(session('project_'.$filter_type)){
			$data = session('project_'.$filter_type);
		}else{
			$data = $filters[$filter_type];
		}

		return $data;
	}

	public function deleteFilterSessionData($request, $filter_key){
            $request->session()->forget('project_'.$filter_key);
    }
}

