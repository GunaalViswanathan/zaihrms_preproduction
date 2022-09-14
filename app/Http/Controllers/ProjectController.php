<?php

namespace App\Http\Controllers;

use App\Exports\DailyReportExport;
use App\Exports\BenchReportExport;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\View;
use Validator;
use App\Models\User;
use App\Models\Project;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Services\DailyReportService;
use App\Http\Controllers\Controller;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Models\Setting;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Mail;
use Carbon\Carbon;
use DB;

class ProjectController extends Controller
{
    private $projectServices, $reportServices;
    public function __construct(ProjectService $projectServices, DailyReportService $reportServices)
    {
        $this->projectServices = $projectServices;
        $this->reportServices = $reportServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $filter_request = $this->projectServices->filterValue($request);
        if (userHasRole('employee')) {
            $filter_request['userid'] = auth()->user()->id;
        }
        if(!$request->project_managing){
        if (userHasRole('admin')) {
            $filter_request['project_managing'] = auth()->user()->id;
        }
        }
        //Its shows the list of project which is created by the reporting manager
        $project = $this->projectServices->index($filter_request);
        $userid = auth()->user()->id;
        $projects = Project::whereRaw("find_in_set($userid,resource)")->get();
        //this is for filter in resource project update
        $role  = Role::where('name', 'admin')->first();
        $users = User::whereHas('user_role', function ($query) use ($role) {
            $query->where('role_id', $role->id)->orderBy('id', 'ASC');
            $query->where('email','!=',config('larasnap.module_list.hr'));
        })->get();

        return View::make('admin.project.index', ['users' => $project ,'projects' => $projects, 'project_managing'=>$users])->with('filters', $filter_request);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role  = Role::where('name', 'employee')->first();
        $getManager = User::whereHas('user_role', function ($query) use ($role) {
                $query->where('role_id','!=',$role->id)->where('email','!=',config('larasnap.module_list.hr'))
                ->where('email','!=',config('larasnap.module_list.admin'))->orderBy('id', 'ASC');
            })->get();
        $users = array();
        foreach($getManager as $key=>$value)
        {
            $users[$key]=$value;
            $employee= User::where('reporting_to',$value->id)->get()->sortBy(function($query){
                return $query->userProfile->first_name;
            });
            $users[$key]->employee = $employee;
        }

        return View::make('admin.project.create', ['resource' => $users]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|min:3',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'allocated_hours' => 'required|numeric',
            'client_name' => 'required|min:3',
            'client_company' => 'required|min:3',
            'mail' => 'nullable|email',
            'project_type' => 'required',
            'resource' => 'required',
            'project_status' => 'required',
        ], [
            'project_name.required' => 'Project name is required',
            'project_name.min' => 'Project name should be atleast :min characters',
            'start_date' => 'The Start date is required',
            'end_date' => 'The end date is required',
            'allocated_hours' => 'The allocated hours is required',
            'client_name.required' => 'Client name is required',
            'client_name.min' => 'Client name should be atleast :min characters',
            'client_name.max' => 'Project name should not be greater than :max characters',
            'client_company.required' => 'Company name is required',
            'client_company.min' => 'Company name should be atleast :min characters',
            'mail.required' => 'Mail-id is required',
            'mail.email' => 'Mail-id is not valid',
            'mail.unique' => 'Mail-id was already taken',
            'project_type.required' => 'Project type is required',
            'resource.required' => 'Resource is required',
            'project_status.required' => 'Project status is required',
        ]);
        $project = new Project;
        $project->project_name = $request->project_name;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->allocated_hours = $request->allocated_hours;
        $project->client_name = $request->client_name;
        $project->client_company = $request->client_company;
        $project->client_email = $request->mail ? $request->mail : 'NA';
        $project->project_type = $request->project_type;
        $project->resource = implode(',', $request->resource);
        $project->project_status = $request->project_status;
        $project->created_by = auth()->user()->id;
        $project->save();
        $resource = explode(',', $project['resource']);
        $mail = explode(',', setting('admin_notification'));
        if (($exceptMail = array_search(config('larasnap.module_list.hr'), $mail)) !== false) {
            unset($mail[$exceptMail]);
        }
        foreach ($resource as $emp) {
            $get_resource = User::find($emp);
            \Mail::to($get_resource['email'])->cc($mail)->send(new \App\Mail\project_assign($project, $get_resource));
        }

        return redirect()->route('project.index')->with("success", "Saved");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $projectName = Project::find($id);
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'from_date' => 'nullable|date',
                'to_date' => 'nullable|date|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $filter_request = $this->reportServices->filterValue($request);
        if (userHasRole('employee')) {
            $auth = auth()->user()->id;
            $project = Project::select('project_name', 'id')
                ->whereRaw("find_in_set($auth,resource)")
                ->get();
            $filter_request['resources'] = auth()->user()->id;
            $filter_request['project_name'] = $id;
        } else {
            $project = Project::select('project_name', 'id')->get();
            $filter_request['project_name'] = $id;
        }
        $role  = Role::where('name', 'employee')->first();
        $users = User::whereHas('user_role', function ($query) use ($role, $projectName) {
            $query->where('role_id', $role->id);
            $query->whereIn('user_id', explode(',', $projectName->resource));
        })->get();
        $report = $this->reportServices->index($filter_request);
        return View::make('admin.project.show', ['report_id' => $projectName, 'users' => $report, 'resources' => $users, 'project' => $project])->with('filters', $filter_request);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $project = Project::findOrFail($id);
            $role  = Role::where('name', 'employee')->first();
            $getManager = User::whereHas('user_role', function ($query) use ($role) {
                    $query->where('role_id','!=',$role->id)->where('email','!=',config('larasnap.module_list.hr'))
                    ->where('email','!=',config('larasnap.module_list.admin'))->orderBy('id', 'ASC');
                })->get();
            $users = array();
        $users = array();
        foreach($getManager as $key=>$value)
        {
            $users[$key]=$value;
            $employee= User::where('reporting_to',$value->id)->get();
            $users[$key]->employee = $employee;
        }
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('project.index')->withError('Employee not found by ID ' . $id);
        }

        return View::make('admin.project.edit', ['resource' => $users, 'project' => $project]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_name' => 'required|min:3',
            'client_name' => 'required|min:3',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'allocated_hours' => 'required',
            'client_company' => 'required|min:3',
            'mail' => 'nullable',
            'project_type' => 'required',
            'resource' => 'required',
            'project_status' => 'required',
        ], [
            'project_name.required' => 'Project name is required',
            'project_name.min' => 'Project name should be atleast :min characters',
            'start_date' => 'The Start date is required',
            'end_date' => 'The end date is required',
            'allocated_hours' => 'The allocated hours is required',
            'client_name.required' => 'Client name is required',
            'client_name.min' => 'Client name should be atleast :min characters',
            'client_name.max' => 'Project name should not be greater than :max characters',
            'client_company.required' => 'Company name is required',
            'client_company.min' => 'Company name should be atleast :min characters',
            'mail.required' => 'Mail-id is required',
            'project_type.required' => 'Project type is required',
            'resource.required' => 'Resource is required',
            'project_status.required' => 'Project status is required',
        ]);
        $project = Project::find($id);
        $employee = explode(',', $project['resource']);
        $project->project_name = $request->project_name;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->allocated_hours = $request->allocated_hours;
        $project->client_name = $request->client_name;
        $project->client_company = $request->client_company;
        $project->client_email = $request->mail ? $request->mail : ' ';
        $project->project_type = $request->project_type;
        $project->resource = implode(',', $request->resource);
        $project->project_status = $request->project_status;
        $project->updated_by = auth()->user()->id;
        $project->update();
        $resource = explode(',', $project['resource']);
        $mail = explode(',', setting('admin_notification'));
        if (($exceptMail = array_search(config('larasnap.module_list.hr'), $mail)) !== false) {
            unset($mail[$exceptMail]);
        }
        foreach ($resource as $get_employee) {
            $get_emp = $get_employee;
            if (!in_array($get_emp, $employee)) {
                $get_resource = User::find($get_emp);
                \Mail::to($get_resource['email'])->cc($mail)->send(new \App\Mail\project_assign($project, $get_resource));
            }
        }
        return redirect()->route('project.index')->with("success", "Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('project.index')->with("success", "Archieved sucessfully");
    }
    public function reportCreate()
    {
        $auth = auth()->user()->id;
        $project = Project::select('project_name', 'id')
            ->whereRaw("find_in_set($auth,resource)")
            ->get();
        return View::make('admin.project.project_report.create', ['project' => $project]);
    }
    public function reportStore(Request $request)
    {
        foreach ($request->rows as $key => $value) {
            $dailyReport = new Report([
                'user_id' => Auth::id(),
                'work_mode' => $value['work_mode'],
                'project_id' => isset($value['project_name']) ? $value['project_name'] : NULL,
                'date' => $value['date'],
                'hours_spent' => $value['hours_spent'],
                'description' => $value['description'],
            ]);
            $dailyReport->save();

            }
       
        $user = User::find(Auth::id());
        $reportingMail = User::where('id',$user->reporting_to)->first()->email;
        $role = Role::where('name', 'super-admin')->first();
        $ccMail = User::whereHas('user_role', function ($query) use ($role) {
            $query->where('role_id', $role->id);
	    $query->where('status','!=',0);
        })->pluck('email')->toArray();
        if($reportingMail == "gavaskar@zaigoinfotech.com"){
            \Mail::to(reportingEmail($user->reporting_to))->send(new \App\Mail\DailyReport($user,$request->rows));
        }elseif($reportingMail == "ganesh@zaigoinfotech.com"){
            \Mail::to(reportingEmail($user->reporting_to))->cc('gavaskar@zaigoinfotech.com')->send(new \App\Mail\DailyReport($user,$request->rows));
        }else{
            \Mail::to(reportingEmail($user->reporting_to))->cc($ccMail)->send(new \App\Mail\DailyReport($user,$request->rows));
        }
        // $project_id = isset($value['project_name']) ? $value['project_name']: NULL;
        //$value['project_name'] for redirect to project report show
        return redirect()->route('project.index')->with("success", "Saved");
    }
    function reportIndex(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'from_date' => 'nullable|date',
                'to_date' => 'nullable|date|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return redirect()->route('project.daily_report_index')->withErrors($validator)->withInput();
            }
        }
        $project = Project::select('project_name', 'id')->get();
        $role  = Role::where('name', 'employee')->first();
        if (!$request->project_name) {
            $users = User::whereHas('user_role', function ($query) use ($role) {
                $query->where('role_id', $role->id);
            })->get();
        } else {
            $getResource = Project::find($request->project_name);
            $users = User::whereHas('user_role', function ($query) use ($role, $getResource) {
                $query->where('role_id', $role->id);
                $query->whereIn('user_id', explode(',', $getResource->resource));
            })->get();
        }
        $filter_request = $this->reportServices->filterValue($request);
        $report = $this->reportServices->index($filter_request);
        return View::make('admin.project.project_report.index', ['users' => $report, 'project' => $project, 'resources' => $users])->with('filters', $filter_request);
    }
    public function autoSearch(Request $request)
    {
        $input = $request->input;
        $userid = auth()->user()->id;
        $project = Project::where('project_name', 'LIKE', '%' . $input . '%')->whereRaw("find_in_set($userid,resource)")->get();
        if (!$project->isEmpty()) {
            $output = '<ul class="list-unstyled">';
            foreach ($project as $projects) {
                $output .= '<li data-id="' . $projects->project_name . '" data-value="' . $projects->project_name . '" >' . $projects->project_name . '</li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function exportReport(Request $request)
    {
        return Excel::download(new DailyReportExport($request->all()), 'dailyreport_' . date('d-m-Y') . '.' . $request->export_format);
    }
    public function benchExportReport(Request $request)
    {
        return Excel::download(new BenchReportExport($request->all()), 'dailyreportbench_' . date('d-m-Y') . '.' . $request->export_format);
    }
    public function benchIndex(Request $request)
    {
        $role  = Role::where('name', 'employee')->first();
        $users = User::whereHas('user_role', function ($query) use ($role) {
            $query->where('role_id', $role->id);
        })->get();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'from_date' => 'nullable|date',
                'to_date' => 'nullable|date|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return redirect()->route('daily_report.bench')->withErrors($validator)->withInput();
            }
        }
        $filter_request = $this->reportServices->filterValue($request);
        if (userHasRole('employee')) {
            $filter_request['resources'] = auth()->user()->id;
        }
        $report = $this->reportServices->index($filter_request);
        return View::make('admin.project.bench.bench_index', ['users' => $report, 'resources' => $users])->with('filters', $filter_request);
    }
    public function UnArchive($id){
        Project::withTrashed()->find($id)->restore();
        return redirect()->route('project.archive_index')->with("success", "Archived Datas are shown");
    }
    public function archiveIndex(Request $request){
        $filter_request = $this->projectServices->filterValue($request);
        if (userHasRole('employee')) {
            $filter_request['userid'] = auth()->user()->id;
        }
        if(!$request->project_managing){
        if (userHasRole('admin')) {
            $filter_request['project_managing'] = auth()->user()->id;
        }
        }
        //Its shows the list of project which is created by the reporting manager
        $project = Project::onlyTrashed()->get();        ;
        $userid = auth()->user()->id;
        $projects = Project::whereRaw("find_in_set($userid,resource)")->get(); 
        //this is for filter in resource project update
        $role  = Role::where('name', 'admin')->first();
        $users = User::whereHas('user_role', function ($query) use ($role) {
            $query->where('role_id', $role->id)->orderBy('id', 'ASC');
            $query->where('email','!=',config('larasnap.module_list.hr'));
        })->get();
        
        return View::make('admin.project.archive', ['users' => $project ,'projects' => $projects, 'project_managing'=>$users])->with('filters', $filter_request);
    }
    // public function PermanentDestroy($id)
    // {
    //     $projectDelete = Project::find($id);
    //     $projectDelete->forceDelete();
    //     return redirect()->route('project.archive_index')->with("success", "Deleted sucessfully");
    // }
}
