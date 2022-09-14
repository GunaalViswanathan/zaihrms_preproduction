<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Http\Requests\PolicyAndDocumentsRequest;
use App\Models\Announcement;
use App\Models\PolicyAndDocuments;
use App\Services\AnnouncementServices;
use App\Services\PolicyAndDocumentsServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PolicyAndDocumentsController extends Controller
{
    private $policyAndDocumentsServices;
    use \LaraSnap\LaravelAdmin\Traits\Role;

    public function __construct(PolicyAndDocumentsServices $policyAndDocumentsServices)
    {
        $this->policyAndDocumentsServices= $policyAndDocumentsServices;
    }

    public function index(Request $request){
        setCurrentListPageURL('announcement');
        $filter_request = $this->policyAndDocumentsServices->filterValue($request); //filter request
        $policyAndDocuments          = $this->policyAndDocumentsServices->index($filter_request);
        $role=loginUserRole(auth()->user()->id);
        if($role=='Employee'){
            return view('admin.employee.policyanddocuments.index')->with('policyanddocuments',$policyAndDocuments)->with('filters',$filter_request);
        }
        return view('admin.policyanddocuments.index')->with('policyanddocuments',$policyAndDocuments)->with('filters',$filter_request);
    }

    public function create(){
        return view('admin.policyanddocuments.create');
    }

    public function store(PolicyAndDocumentsRequest $request){
        $user = $this->policyAndDocumentsServices->store($request);
        return redirect()->route('policyanddocuments.index')->withSuccess('Policy Created Successfully');
    }

    public function edit($id){
        try {
            $policyanddocuments=PolicyAndDocuments::find($id);
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('policyanddocuments.index')->withErrors('Policy not found by ID ' .$id);
        }
        return  view('admin.policyanddocuments.edit',compact('policyanddocuments'));
    }

    public function update(PolicyAndDocumentsRequest $request,$id){
        try {
            $policy=PolicyAndDocuments::find($id);
            $this->policyAndDocumentsServices->update($request, $id, $policy);
            return redirect()->route('policyanddocuments.index')->withSuccess('Policy updated successfully');
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('policyanddocuments.index')->withErrors('Policy not found by ID '.$id);
        }

    }
    public function show($id) {
        try {
            $policyanddocuments = PolicyAndDocuments::findOrFail($id);

        }catch (ModelNotFoundException $exception) {
            return redirect()->route('policyanddocuments.index')->withError('Policy not found by ID ' .$id);
        }
        return view('admin.policyanddocuments.show', compact('policyanddocuments'));
    }
    public function destroy($id){
        try {
            $policy = PolicyAndDocuments::findOrFail($id);
            $this->policyAndDocumentsServices->destroy($id, $policy);
            return redirect()->route('policyanddocuments.index')->withSuccess('Policy successfully deleted.');
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('policyanddocuments.index')->withError('Policy not found by ID ' .$id);
        }
    }

    public function bulkdestroy(Request $request){
        $idsToDelete = $request->records;
        if (count($idsToDelete)>0) {
            $this->policyAndDocumentsServices->bulkDelete($idsToDelete);
            return redirect()->route('policyanddocuments.index')->withSuccess('Selected Policy successfully deleted.');
        }
    }

    public function listData(Request $request){
        $entriesPerPage = setting('entries_per_page');
        $policyanddocuments=PolicyAndDocuments::orderBy('id','Desc')->paginate($entriesPerPage);
        return view('admin.policyanddocuments.list')->with(['policyanddocuments' => $policyanddocuments]);
    }

    public function editform(Request $request){
        try {
            $policy = PolicyAndDocuments::findOrFail($request->id);

        }catch (ModelNotFoundException $exception) {
            return redirect()->route('policyanddocuments.index')->withError('policy not found by ID ' .$request->id);
        }

        return response()->json(['data'=>$policy]);
    }
}
