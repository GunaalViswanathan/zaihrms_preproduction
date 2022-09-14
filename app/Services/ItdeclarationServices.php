<?php

namespace App\Services;

use App\Filters\HolidayFilters;
use App\Filters\ItdeclarationFilters;
use App\Models\Holidays;
use App\Models\Itdeclaration;
use App\Models\ItdeclarationDocument;
use File;
use Illuminate\Support\Facades\Auth;
use LaraSnap\LaravelAdmin\Traits\Upload;
use LaraSnap\LaravelAdmin\Models\UserProfile;

class ItdeclarationServices{

	use Upload;

    private $filters;

    /**
     * Injecting UserFilters.
     */
    public function __construct(ItdeclarationFilters $filters)
    {
        $this->filters = $filters;
    }

	public function index($filter_request){
		$entriesPerPage = 15;
        $declaration =Itdeclaration::where('employee_id',\auth()->user()->id)->filter($this->filters, $filter_request)->orderBy('id','desc')->paginate($entriesPerPage);
		return $declaration;
	}

	// return filter request values
	public function filterValue($request){
		/*filter-array keys should be same as the filter-field name*/
		/*Declare filter variables*/
        $filters['sort_by']     = config('larasnap.module_list.user.sort_by')[0]['value'];
        $filters['search']      = null;
        $filters['category']      = 'all';

		/*If filter has values or if user accessing page via pagination, show filter values*/
		if($request->page || $request->sort_by || $request->search || $request->category ){
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
            session(['declaration' . $filter_type => $data]);
        }elseif($request->has($filter_type) && $request->{$filter_type} == '' ){
            session(['declaration' . $filter_type => '']);
            $data = $filters[$filter_type];
        }elseif(session('declaration'.$filter_type)){
			$data = session('declaration'.$filter_type);
		}else{
			$data = $filters[$filter_type];
		}

		return $data;
	}

	public function deleteFilterSessionData($request, $filter_key){
            $request->session()->forget('declaration'.$filter_key);
    }

	public function store($request){
//	    $category=array_filter($request->category);
//	    $subcategory=array_filter($request->childcategory);
//	    $company_name=array_filter($request->company_name);
//        $amount=array_filter($request->amount);
//        $address=array_filter($request->address);
//        $documents=array_filter($request->documents);
//        for($count=0;$count<2;$count++){
//            $saveInput[]=[
//                'category_id'=>$category[$count] ?$category[$count]:"",
//                'sub_category_id'=>$subcategory[$count] ? $subcategory[$count]:"",
//                'name'=>$company_name[$count] ? $company_name[$count]:"",
//                'employee_id'=>\auth()->user()->id,
//                'amount'=>$amount[$count] ?$amount[$count]:"",
////                'address'=>$address[$count] ? $address[$count]:"",
//            ];
////            echo "<pre>";print_r($saveInput);
//        }
//        dd($saveInput);

        $data['category_id']=$request->category;
        $data['employee_id']=\auth()->user()->id;
        $data['sub_category_id']=$request->childcategory;
        $data['name']=$request->company_name;
        $data['amount']=$request->amount;
        $data['address']=$request->address;
        $declaration=Itdeclaration::create($data);
        /* handle if douments uploaded*/
        if ($request->has('documents')) {
            $documents = $request->file('documents');

            foreach ($documents as $document){
                $prefix='document_'.rand(0000,9999);
                $folder = config('larasnap.uploads.itdeclaration.path');
                $docName = $this->upload($document, $folder, $prefix, $declaration->id);
                $uploadDocument['itdeclaration_id']=$declaration->id;
                $uploadDocument['filename']=$docName;
                ItdeclarationDocument::create($uploadDocument);
            }

        }
		return $declaration;
	}

    public function update($request, $id, $declaration){
        $data['category_id']=$request->category;
        $data['sub_category_id']=$request->childcategory;
        $data['name']=$request->company_name;
        $data['amount']=$request->amount;
        $data['address']=$request->address;
        /* handle if douments uploaded*/
        if ($request->has('documents')) {
            $documents = $request->file('documents');

            foreach ($documents as $document){
                $prefix='document_'.rand(0000,9999);
                $folder = config('larasnap.uploads.itdeclaration.path');
                $docName = $this->upload($document, $folder, $prefix, $declaration->id);
                $uploadDocument['itdeclaration_id']=$declaration->id;
                $uploadDocument['filename']=$docName;
                ItdeclarationDocument::create($uploadDocument);
            }

        }
        $declaration->update($data);

        return $declaration;
    }

    public function destroy($id, $declaration){

        foreach ($declaration->itdeclarationdocument as $document) {
            $folder = config('larasnap.uploads.itdeclaration.path');
            File::delete(storage_path() .'/app/' .$folder .'/'. $document->filename);
        }
        $declaration = $declaration->delete();
        return $declaration;
    }

	public function bulkDelete($idsToDelete){

        $declarationdocument = ItdeclarationDocument::whereIn('itdeclaration_id', $idsToDelete)->get();
        foreach ($declarationdocument as $document) {
            $folder = config('larasnap.uploads.itdeclaration.path');
            File::delete(storage_path() .'/app/' .$folder .'/'. $document->filename);
        }
        $declaration = Itdeclaration::whereIn('id', $idsToDelete)->delete();
	    return $declaration;
    }
    public function destroydoument($id,$declarationdocument){
        if($declarationdocument->filename) {
            $folder = config('larasnap.uploads.itdeclaration.path');
            File::delete(storage_path() .'/app/' .$folder .'/'. $declarationdocument->filename);
        }
        $declarationdocument = $declarationdocument->delete();
        return $declarationdocument;
    }

}
