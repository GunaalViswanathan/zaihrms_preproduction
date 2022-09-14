<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PaySlipExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HelpDeskRequest;
use App\Mail\Tickets;
use App\Models\HelpDesk;
use App\Services\HelpDeskServices;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\Category;
use Maatwebsite\Excel\Facades\Excel;

class HelpdeskController extends Controller
{
    private $helpDeskServices;

    public function __construct(HelpDeskServices $helpDeskServices)
    {
        $this->helpDeskServices= $helpDeskServices;
    }

    public function index(Request $request){
        setCurrentListPageURL('helpdesks');
        $filter_request=$this->helpDeskServices->filterValue($request);
        $helpdesk=$this->helpDeskServices->index($filter_request);
            return view('admin.employee.helpdesk.index')->with('helpdesks',$helpdesk)->with('filters',$filter_request);


    }
    public function create(){
        $categories=Category::where('name','help-desks')->first();
        return view('admin.employee.helpdesk.create',compact('categories'));
    }

    public function store(HelpDeskRequest $request){
        $user = $this->helpDeskServices->store($request);
        return redirect()->route('helpdesks.index')->withSuccess('Helpdesk Created Successfully');
    }

    public function edit($id){
        try {
            $helpdesk=HelpDesk::find($id);
            $categories=Category::where('name','help-desks')->first();
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('helpdesks.index')->withErrors('Helpdesk not found by ID ' .$id);
        }
        return  view('admin.employee.helpdesk.edit',compact('helpdesk','categories'));
    }

    public function update(HelpDeskRequest $request,$id){
        try {
            $helpdesk=HelpDesk::find($id);
            $this->helpDeskServices->update($request, $id, $helpdesk);
            return redirect()->route('helpdesks.index')->withSuccess('Helpdesk updated successfully');
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('helpdesks.index')->withErrors('Helpdesk not found by ID '.$id);
        }

    }
    public function show($id) {
        try {
            $helpdesk = HelpDesk::findOrFail($id);

        }catch (ModelNotFoundException $exception) {
            return redirect()->route('helpdesks.index')->withError('Helpdesk not found by ID ' .$id);
        }
        return view('admin.employee.helpdesk.show', compact('helpdesk'));
    }
    public function destroy($id){
        try {
            $helpdesk = HelpDesk::findOrFail($id);
            $this->helpDeskServices->destroy($id, $helpdesk);
            return redirect()->route('helpdesks.index')->withSuccess('Helpdesk successfully deleted.');
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('helpdesks.index')->withError('Helpdesk not found by ID ' .$id);
        }
    }

    public function bulkdestroy(Request $request){
        $idsToDelete = $request->records;
        if (count($idsToDelete)>0) {
            $this->helpDeskServices->bulkDelete($idsToDelete);
            return redirect()->route('helpdesks.index')->withSuccess('Selected Helpdesk successfully deleted.');
        }
    }
    public function updateticketstatus(Request $request,$id){
        try {

            $helpdesk=HelpDesk::find($id);
            $updateStatus['status']=$request->ticket_status;
            $helpdesk->update($updateStatus);
            Mail::to("naveen.a@zaigoinfotech.com")->send(new Tickets(HelpDesk::find($id)));
            return redirect()->route('helpdesks.index')->withSuccess('Ticket Status successfully Updated.');
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('helpdesks.index')->withError('Helpdesk not found by ID ' .$id);
        }
    }
    public function getSearch(Request $request)
    {
        $input = $request->input;
        $modules = HelpDesk::orWhere('subject', 'LIKE', '%' . $input . '%')->orWhere('ticket_id', 'LIKE', '%' . $input . '%')->get();

        if (!$modules->isEmpty()) {
            $output = '<ul class="list-unstyled">';
            foreach($modules as $module){
                $output .= '<li data-id="'.$module->id.'" data-value="'.$module->subject.'">'.$module->subject.'</li>';
            }
            $output .= '</ul>';
            echo $output;
            //return response()->json(['data'=> $output ]);
        }

    }

    public function PaySlipView(){
        return view('admin.employee.payroll.index');
    }
    public function PaySlip(){
        $pdf = PDF::loadView('admin.export.index');
        return $pdf->download('invoice.pdf');
    }

}
