<?php

namespace App\Services;

use App\Filters\AnnouncementFilters;
use App\Filters\PolicyAndDocumentsFilters;
use App\Models\Announcement;
use App\Models\PolicyAndDocuments;
use File;
use Illuminate\Support\Facades\Auth;
use LaraSnap\LaravelAdmin\Traits\Upload;
use LaraSnap\LaravelAdmin\Models\UserProfile;

class PolicyAndDocumentsServices{

	use Upload;

    private $filters;

    /**
     * Injecting UserFilters.
     */
    public function __construct(PolicyAndDocumentsFilters $filters)
    {
        $this->filters = $filters;
    }

	public function index($filter_request){
		$entriesPerPage = setting('entries_per_page');
        $policyandDocuments =PolicyAndDocuments::filter($this->filters, $filter_request)->orderBy('id','Desc')->paginate($entriesPerPage);
		return $policyandDocuments;
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
            session(['policy_and_documents_' . $filter_type => $data]);
        }elseif($request->has($filter_type) && $request->{$filter_type} == '' ){
            session(['policy_and_documents_' . $filter_type => '']);
            $data = $filters[$filter_type];
        }elseif(session('policy_and_documents_'.$filter_type)){
			$data = session('policy_and_documents_'.$filter_type);
		}else{
			$data = $filters[$filter_type];
		}

		return $data;
	}

	public function deleteFilterSessionData($request, $filter_key){
            $request->session()->forget('policy_and_documents_'.$filter_key);
    }

	public function store($request){
        $data['title']=$request->policy_name;
        $data['description']=$request->description;

        $policy=PolicyAndDocuments::create($data);
        $policyId=$policy->id;
        /* handle if doument uploaded*/
        if ($request->has('document')) {
            $image = $request->file('document');
            $folder = config('larasnap.uploads.policyanddocument.path');
            $imgName = $this->upload($image, $folder, 'document', $policyId);
            $uploadDocument['document']=$imgName;
            $policy->update($uploadDocument);
        }

		return $policy;
	}

    public function update($request, $id, $policyanddocuments){

	   $data['title']=$request->policy_name;
	   $data['description']=$request->description;
        $policyanddocuments->update($data);
        /* handle if document uploaded*/
        if ($request->has('document')) {
            $image = $request->file('document');
            $folder = config('larasnap.uploads.policyanddocument.path');
            if ($policyanddocuments->document) {
                File::delete(storage_path() .'/app/' .$folder .'/'. $policyanddocuments->document);
            }

            $imgName = $this->upload($image, $folder, 'document', $id);
            $uploadDocument['document'] = $imgName;
            $policyanddocuments->update($uploadDocument);
        }

        return $policyanddocuments;
    }

    public function destroy($id, $policyanddocuments){
        if ($policyanddocuments->filename) {
            $folder = config('larasnap.uploads.policyanddocument.path');
            File::delete(storage_path() .'/app/' .$folder .'/'. $policyanddocuments->filename);
        }
        $policyanddocuments = $policyanddocuments->delete();

        return $policyanddocuments;
    }

	public function bulkDelete($idsToDelete){
	    $selectedPolicy = PolicyAndDocuments::whereIn('id', $idsToDelete)->get();
	    $imgArray = [];
	    foreach ($selectedPolicy as $policy){
            if ($policy->filename) {
                $folder = config('larasnap.uploads.policyanddocument.path');
                $img = storage_path() .'/app/' .$folder .'/'. $policy->filename;
                array_push($imgArray, $img);
            }
        }
        File::delete($imgArray);

	    $policyanddocuments = PolicyAndDocuments::whereIn('id', $idsToDelete)->delete();

	    return $policyanddocuments;
    }

}
