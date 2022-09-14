<?php

namespace App\Services;

use App\Filters\HelpDeskFilters;
use App\Filters\HolidayFilters;
use App\Mail\Tickets;
use App\Models\HelpDesk;
use App\Models\Holidays;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use LaraSnap\LaravelAdmin\Traits\Upload;
use LaraSnap\LaravelAdmin\Models\UserProfile;

class HelpDeskServices{

	use Upload;

    private $filters;

    /**
     * Injecting UserFilters.
     */
    public function __construct(HelpDeskFilters $filters)
    {
        $this->filters = $filters;
    }

	public function index($filter_request){
		$entriesPerPage = 15;
        $users =HelpDesk::filter($this->filters, $filter_request)->orderBy('id','Desc')->paginate($entriesPerPage);
		return $users;
	}

	// return filter request values
	public function filterValue($request){
		/*filter-array keys should be same as the filter-field name*/
		/*Declare filter variables*/
        $filters['sort_by']     = config('larasnap.module_list.user.sort_by')[0]['value'];
        $filters['search']      = null;
        $filters['status']      = null;
        $filters['priority']      = null;

		/*If filter has values or if user accessing page via pagination, show filter values*/
		if($request->page || $request->sort_by || $request->search || $request->status ||$request->priority || $request->category){
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
            session(['ticket_' . $filter_type => $data]);
        }elseif($request->has($filter_type) && $request->{$filter_type} == '' ){
            session(['ticket_' . $filter_type => '']);
            $data = $filters[$filter_type];
        }elseif(session('ticket_'.$filter_type)){
			$data = session('ticket_'.$filter_type);
		}else{
			$data = $filters[$filter_type];
		}

		return $data;
	}

	public function deleteFilterSessionData($request, $filter_key){
            $request->session()->forget('ticket_'.$filter_key);
    }

	public function store($request){
        $data['subject']=$request->subject;
        $data['category_id']=$request->category;
        $data['images']=$request->images;
        $data['description']=$request->description;
        $helpdesk=HelpDesk::create($data);
        $ticket['ticket_id']="TICKET".rand(0000,9999).$helpdesk->id;
        if ($request->has('images')) {
            $image = $request->file('images');
            $folder = config('larasnap.uploads.ticket.path');
            $imgName = $this->upload($image, $folder, 'ticket', rand(0000,9999).$helpdesk->id);
            $ticket['images']=$imgName;
        }
        $helpdesk->update($ticket);
        Mail::to("naveen.a@zaigoinfotech.com")->send(new Tickets(HelpDesk::find($helpdesk->id)));
		return $helpdesk;
	}

    public function update($request, $id, $helpdesk){
        $data['subject']=$request->subject;
        $data['category_id']=$request->category;
        $data['images']=$request->images;
        $data['description']=$request->description;
        if ($request->has('images')) {
            $image = $request->file('images');
            $folder = config('larasnap.uploads.ticket.path');
            if ($helpdesk->images) {
                File::delete(storage_path() .'/app/' .$folder .'/'. $helpdesk->images);
            }
            $imgName = $this->upload($image, $folder, 'ticket', rand(0000,9999).$helpdesk->id);
            $data['images']=$imgName;
        }
        $helpdesk->update($data);

        return $helpdesk;
    }

    public function destroy($id, $helpdesk){
        if ($helpdesk->images) {
            $folder = config('larasnap.uploads.ticket.path');
            File::delete(storage_path() .'/app/' .$folder .'/'. $helpdesk->images);
        }
        $helpdesk = $helpdesk->delete();
        return $helpdesk;
    }

	public function bulkDelete($idsToDelete){
        $selectedticket = HelpDesk::whereIn('id', $idsToDelete)->get();
        $imgArray = [];
        foreach ($selectedticket as $ticket){
            if ($ticket->images) {
                $folder = config('larasnap.uploads.ticket.path');
                $img = storage_path() .'/app/' .$folder .'/'. $ticket->images;
                array_push($imgArray, $img);
            }
        }
        File::delete($imgArray);

	    $holiday = HelpDesk::whereIn('id', $idsToDelete)->delete();
	    return $holiday;
    }

}
