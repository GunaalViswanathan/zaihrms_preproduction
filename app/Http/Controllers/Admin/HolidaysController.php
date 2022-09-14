<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HolidayRequest;
use App\Models\Holidays;
use App\Services\HolidayServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HolidaysController extends Controller
{
    private $holidayServices;

    public function __construct(HolidayServices $holidayServices)
    {
        $this->holidayServices= $holidayServices;
    }

    public function index(Request $request){
        setCurrentListPageURL('holidays');
        $filter_request=$this->holidayServices->filterValue($request);
        $holidays=$this->holidayServices->index($filter_request);
        $role=loginUserRole(auth()->user()->id);
        if($role=='Employee'){
            return view('admin.employee.holiday.index')->with('holidays',$holidays)->with('filters',$filter_request);
        }
        return view('admin.holiday.index')->with('holidays',$holidays)->with('filters',$filter_request);

    }
    public function create(){
        return view('admin.holiday.create');
    }

    public function store(HolidayRequest $request){
        $user = $this->holidayServices->store($request);
        return redirect()->route('holidays.index')->withSuccess('Holiday Created Successfully');
    }

    public function edit($id){
        try {
            $holidays=Holidays::find($id);
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('holidays.index')->withErrors('Holiday not found by ID ' .$id);
        }
        return  view('admin.holiday.edit',compact('holidays'));
    }

    public function update(HolidayRequest $request,$id){
        try {
            $holiday=Holidays::find($id);
            $this->holidayServices->update($request, $id, $holiday);
            return redirect()->route('holidays.index')->withSuccess('Holiday updated successfully');
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('holidays.index')->withErrors('Holiday not found by ID '.$id);
        }

    }
    public function show($id) {
        try {
            $holidays = Holidays::findOrFail($id);

        }catch (ModelNotFoundException $exception) {
            return redirect()->route('holidays.index')->withError('Holiday not found by ID ' .$id);
        }
        return view('admin.holiday.show', compact('holidays'));
    }
    public function destroy($id){
        try {
            $holiday = Holidays::findOrFail($id);
            $this->holidayServices->destroy($id, $holiday);
            return redirect()->route('holidays.index')->withSuccess('Holiday successfully deleted.');
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('holidays.index')->withError('Holiday not found by ID ' .$id);
        }
    }

    public function bulkdestroy(Request $request){
        $idsToDelete = $request->records;
        if (count($idsToDelete)>0) {
            $this->holidayServices->bulkDelete($idsToDelete);
            return redirect()->route('holidays.index')->withSuccess('Selected Holidays successfully deleted.');
        }
    }
}
