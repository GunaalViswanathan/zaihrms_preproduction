<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Services\AnnouncementServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{
    private $AnnouncementServices;
    use \LaraSnap\LaravelAdmin\Traits\Role;

    public function __construct(AnnouncementServices $AnnouncementServices)
    {
        $this->AnnouncementServices= $AnnouncementServices;
    }

    public function index(Request $request){
        setCurrentListPageURL('announcement');
        $filter_request = $this->AnnouncementServices->filterValue($request); //filter request
        $announcement          = $this->AnnouncementServices->index($filter_request);
        $role=loginUserRole(auth()->user()->id);
        if($role=='Employee'){
            return view('admin.employee.announcement.index')->with('announcements',$announcement)->with('filters',$filter_request);
        }
        return view('admin.announcement.index')->with('announcements',$announcement)->with('filters',$filter_request);
    }

    public function create(){
        return view('admin.announcement.create');
    }

    public function store(AnnouncementRequest $request){
        $user = $this->AnnouncementServices->store($request);
        return redirect()->route('announcement.index')->withSuccess('Announcement Created Successfully');
    }

    public function edit($id){
        try {
            $announcement=Announcement::find($id);
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('announcement.index')->withErrors('Announceemnt not found by ID ' .$id);
        }
        return  view('admin.announcement.edit',compact('announcement'));
    }

    public function update(AnnouncementRequest $request,$id){
        try {
            $announcement=Announcement::find($id);
            $this->AnnouncementServices->update($request, $id, $announcement);
            return redirect()->route('announcement.index')->withSuccess('Announcement updated successfully');
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('announcement.index')->withErrors('Announcement not found by ID '.$id);
        }

    }
    public function show($id) {
        try {
            $announcement = Announcement::findOrFail($id);

        }catch (ModelNotFoundException $exception) {
            return redirect()->route('announcement.index')->withError('Announcement not found by ID ' .$id);
        }
        return view('admin.announcement.show', compact('announcement'));
    }
    public function destroy($id){
        try {
            $announcement = Announcement::findOrFail($id);
            $this->AnnouncementServices->destroy($id, $announcement);
            return redirect()->route('announcement.index')->withSuccess('Announcement successfully deleted.');
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('announcement.index')->withError('Announcement not found by ID ' .$id);
        }
    }

    public function bulkdestroy(Request $request){
        $idsToDelete = $request->records;
        if (count($idsToDelete)>0) {
            $this->AnnouncementServices->bulkDelete($idsToDelete);
            return redirect()->route('announcement.index')->withSuccess('Selected Announcement successfully deleted.');
        }
    }
    public function listData(Request $request){
        $entriesPerPage = setting('entries_per_page');
        $announcement=Announcement::orderBy('id','Desc')->paginate($entriesPerPage);
        return view('admin.announcement.list')->with(['announcements' => $announcement]);
    }
    public function editform(Request $request){
        try {
            $announcement = Announcement::findOrFail($request->id);

        }catch (ModelNotFoundException $exception) {
            return redirect()->route('announcement.index')->withError('Announcement not found by ID ' .$request->id);
        }

        return response()->json(['data'=>$announcement]);
    }
}
