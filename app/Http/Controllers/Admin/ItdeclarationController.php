<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HolidayRequest;
use App\Http\Requests\Admin\ItdeclarationRequest;
use App\Models\Holidays;
use App\Models\Itdeclaration;
use App\Models\ItdeclarationDocument;
use App\Models\User;
use App\Services\EmployeeService;
use App\Services\HolidayServices;
use App\Services\ItdeclarationServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\Category;
use Illuminate\Support\Facades\Validator;

class ItdeclarationController extends Controller
{
    private $itDeclarationServices;

    public function __construct(ItdeclarationServices $itDeclarationServices)
    {
        $this->itDeclarationServices= $itDeclarationServices;
    }

    public function index(Request $request){
        setCurrentListPageURL('itdeclaration');
        $filter_request=$this->itDeclarationServices->filterValue($request);
        $declaration=$this->itDeclarationServices->index($filter_request);
        $role=loginUserRole(auth()->user()->id);
        $category=Category::where('name','it-declaration')->first();
        $subcategory=Category::where('name','any-investments')->first();
        if($role=='Employee'){
            return view('admin.employee.itdeclaration.index')->with('declaration',$declaration)->with('filters',$filter_request)->with('category',$category)->with('subcategory',$subcategory);

        }

        $employee=User::whereHas('user_role',function ($query){
            $query->where('role_id',3);
        })->paginate(10);

        return view('admin.itdeclaration.index')->with('users',$employee)->with('filters',$filter_request)->with('category',$category)->with('subcategory',$subcategory);

    }
    public function create(){
        $category=Category::where('name','it-declaration')->first();
        $subcategory=Category::where('name','any-investments')->first();

        return view('admin.employee.itdeclaration.create',compact(['category','subcategory']));
//        return view('admin.employee.itdeclaration.addform',compact(['category','subcategory']));
    }

    public function store(Request $request){
//        dd($request->all());
//        if(!$request->has('documents')){
//            return redirect()->back()->withErrors('Please select document');
//        };
        $user = $this->itDeclarationServices->store($request);

        return redirect()->route('itdeclaration.index')->withSuccess('It Declaration Submited Successfully');
    }

    public function edit($id){
        try {
            $declaration=Itdeclaration::find($id);

            $category=Category::where('name','it-declaration')->first();
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('itdeclaration.index')->withErrors('It Declaration not found by ID ' .$id);
        }
        return  response($declaration);
//        return  view('admin.employee.itdeclaration.edit',compact(['declaration','category']));
    }

    public function update(Request $request,$id){
        try {
            $declaration=Itdeclaration::find($id);
            $this->itDeclarationServices->update($request, $id, $declaration);
            return redirect()->route('itdeclaration.index')->withSuccess('It declaration updated successfully');
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('itdeclaration.index')->withErrors('It declaration not found by ID '.$id);
        }

    }
    public function show($id) {
        try {
            $declaration = Itdeclaration::findOrFail($id);

        }catch (ModelNotFoundException $exception) {
            return redirect()->route('itdeclaration.index')->withError('It declaration not found by ID ' .$id);
        }

        return view('admin.employee.itdeclaration.show', compact('declaration'));
    }
    public function destroy($id){
        try {
            $declaration = Itdeclaration::findOrFail($id);
            $this->itDeclarationServices->destroy($id, $declaration);
            return redirect()->route('itdeclaration.index')->withSuccess('It declaration successfully deleted.');
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('itdeclaration.index')->withError('It declaration not found by ID ' .$id);
        }
    }

    public function bulkdestroy(Request $request){
        $idsToDelete = $request->records;
        if (count($idsToDelete)>0) {
            $this->itDeclarationServices->bulkDelete($idsToDelete);
            return redirect()->route('itdeclaration.index')->withSuccess('Selected declaration successfully deleted.');
        }
    }
    public function deletedocument($id){

        try {
            $declaration = ItdeclarationDocument::findOrFail($id);
            $this->itDeclarationServices->destroydoument($id, $declaration);
            return redirect()->back()->withSuccess('Declaration document successfully deleted.');
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('itdeclaration.index')->withError('It declaration document not found by ID ' .$id);
        }
    }
    public function getcategory(Request $request){
        $findcategory=Category::find($request->input);
        if($findcategory->name=='any-investments'){
            $category=Category::where('parent_category_id',$request->input)->get();

            return response()->json(['message'=>'success','result'=>$category,'parent'=>$findcategory]);
        }
        else{
            return response()->json(['message'=>'failure','parent'=>$findcategory]);

        }

    }
    public function listalldata(Request $request){
        setCurrentListPageURL('itdeclaration');
        $filter_request=$this->itDeclarationServices->filterValue($request);
        $declaration=$this->itDeclarationServices->index($filter_request);
        $role=loginUserRole(auth()->user()->id);
        $category=Category::where('name','it-declaration')->first();
        return \response($declaration);
    }
    public function viewDetails(Request $request){
        $validated = $request->validate([
            'employee' => 'required',
        ]);
        $declarations=Itdeclaration::where('employee_id',$request->employee)->orderBy('sub_category_id','asc')->get();
        $users=User::find($request->employee);

        return view('admin.itdeclaration.show',compact(['declarations','users']));
    }
}
