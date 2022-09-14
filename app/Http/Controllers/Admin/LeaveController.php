<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LeaveExport;
use App\Http\Controllers\Controller;
use App\Mail\Leave;
use App\Models\LeaveApply;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\Role;
use Validator;
use Mail;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $entriesPerPage = setting('entries_per_page');
        $data = [];
        if (strtolower(loginUserRole(auth()->user()->id)) == 'employee') {
            $leave = LeaveApply::where('user_id', auth()->user()->id)->orderBy('id', 'DESC');
        } else {
            $leave = LeaveApply::select('id', 'user_id', 'leave_type', 'leave_from', 'leave_to', 'permission_from', 'permission_to', 'no_of_days', 'reason', 'status', 'created_at')->orderBy('id', 'DESC');
        }
        if ($request->sort_by != '') {
            $leave->orderby('id', ($request->sort_by == 'latestfirst') ? 'desc' : 'asc');
        } else {
            $leave->orderByDesc('id');
        }
        /*Status Filter*/
         if ($request->from_date == "" && $request->to_date == "" && $request->user_id == "" && $request->type == "" && $request->status == "" && $request->status == "" ) {
            $leave->whereMonth('created_at', Carbon::now()->month);
        }
        if ($request->status != '') {
            $leave->where('status', $request->status);
        }
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'from_date' => 'nullable|date',
                'to_date' => 'nullable|date|after_or_equal:from_date',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
       
        if ($request->from_date != '') {
            $leave->whereDate('leave_from', '>=', dateFormat($request->from_date));
        }
        if ($request->to_date != '') {
            $leave->whereDate('leave_to', '<=', dateIncludeDays($request->to_date, 0));
        }
        if ($request->user_id != '') {
            $leave->where('user_id', '=', $request->user_id);
        }
        if ($request->type != '') {
            $leave->where('leave_type', '=', $request->type);
        }
        $data['user_id'] = $request->user_id;
        $data['sort_by'] = $request->sort_by;
        $data['from_date'] = $request->from_date;
        $data['to_date'] = $request->to_date;
        $data['status'] = $request->status;
        $data['type'] = $request->type;
        $leave = $leave->paginate($entriesPerPage);
        $role  = Role::where('name', 'employee')->first();
        $users = User::whereHas('user_role', function ($query) use ($role) {
            $query->where('role_id', $role->id);
        })->get();
        return view('admin.leave.index')->with(['leave' => $leave, 'data' => $data, 'users' => $users]);
    }

    public function create()
    {
        return view('admin.leave.create');
    }

    public  function  store(Request $request)
    {
        if ($request->leave_type == 1) {
            $count = dateDiffInDays($request->leave_start_date, $request->leave_end_date);
            $count = $count + 1;
            $validator = Validator::make($request->all(), [
                'leave_start_date' => 'required|date|',
                'leave_end_date' => 'required|date|after_or_equal:leave_start_date',
                'leave_reason' => 'required|min:1|max:300',
            ], [
                'no_of_days.in' => 'The no of days must be ' . $count . ' day(s)',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $now = strtotime($request->leave_start_date); // or your date as well
            $your_date = strtotime($request->leave_end_date);
            $datediff =  $your_date - $now;

            $no_of_days = round($datediff / (60 * 60 * 24), 0);
            // dd($no_of_days);
            $data['user_id'] = auth()->user()->id;
            $data['leave_type'] = $request->leave_type;
            $data['leave_from'] = $request->leave_start_date;
            $data['leave_to'] = $request->leave_end_date;
            $data['no_of_days'] = $no_of_days + 1;
            $data['reason'] = $request->leave_reason;
            $data['status'] = 1;
            $leaveCreate = LeaveApply::create($data);
            /*Email*/
            $user = User::where('id', $leaveCreate->user_id)->first();
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, auth()->user()->email);
            Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leaveCreate, $user));
            // \Mail::to('ragavi7810@gmail.com')->cc($mail)->send(new Leave($leaveCreate, $user));;

            return redirect()->route('leave.index')->withSuccess('Leave applied successfully.');
        }
        if ($request->leave_type == 4) {

            $validator = Validator::make($request->all(), [
                'half_leave_date' => 'required|date|',
                'half_leave_reason' => 'required|min:1|max:300'
            ], [
                'half_leave_date.required' => "Date field is required.",
                'half_leave_reason.required' => "Reason field is required.",
                'half_leave_reason.max' => 'The reason may not be greater than 300 characters.',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['user_id'] = auth()->user()->id;
            $data['leave_type'] = $request->leave_type;
            $data['leave_from'] = $request->half_leave_date;
            $data['leave_to'] = $request->half_leave_date;
            $data['no_of_days'] = "Half Day";
            $data['reason'] = $request->half_leave_reason;
            $data['status'] = 1;
            $leaveCreate = LeaveApply::create($data);
            /*Email*/
            $user = User::where('id', $leaveCreate->user_id)->first();
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, auth()->user()->email);
            Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leaveCreate, $user));
            // \Mail::to('ragavi7810@gmail.com')->cc($mail)->send(new Leave($leaveCreate, $user));;
            return redirect()->route('leave.index')->withSuccess('Leave applied successfully.');
        }
        if ($request->leave_type == 2) {
            $validator = Validator::make($request->all(), [
                'start_time' => 'required|',
                'end_time' => 'required',
                'reason' => 'required|min:1|max:300',
            ]);
            $difference = '';
            if ($request->start_time != '' && $request->end_time != '') {
                $time1 = strtotime($request->start_time);
                $time2 = strtotime($request->end_time);
                $difference = round(abs($time2 - $time1) / 3600);
            }
            if ($difference > 2) {
                $validator->getMessageBag()->add('end_time', 'Please select below 2 hours. Allowed time limit is 2 Hours');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($validator->fails()) {
                if ($difference > 2) {
                    $validator->getMessageBag()->add('end_time', 'Please select below 2 hours. Allowed time limit is 2 Hours');
                }
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['user_id'] = auth()->user()->id;
            $data['leave_type'] = $request->leave_type;
            $data['leave_from'] = $request->start_time;
            $data['leave_to'] = $request->end_time;
            $data['reason'] = $request->reason;
            $data['status'] = 1;
            $leaveCreate = LeaveApply::create($data);
            /*Email*/
            $user = User::where('id', $leaveCreate->user_id)->first();
            // Mail::to(reportingEmail($user->reporting_to))->cc($emailIds)->send(new Leave($leaveCreate, $user));
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, auth()->user()->email);
            Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leaveCreate, $user));

            return redirect()->route('leave.index')->withSuccess('Permission applied successfully.');
        }
        if ($request->leave_type == 3) {
            $validator = Validator::make($request->all(), [
                'start_date'  => 'required|date|',
                'end_date'    => 'required|date|after_or_equal:start_date',
                'work_reason'      => 'required|min:1|max:300',
                'task_type'   => 'required',
                'task_reason' => 'required|min:1|max:300',
                'task_plan'   => 'required',
            ], [
                'task_reason.required' => 'Please specify the reason.',
                'task_plan.required' => 'Work plan is required'

            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $now = strtotime($request->start_date); // or your date as well
            $your_date = strtotime($request->end_date);
            $datediff =  $your_date - $now;

            $no_of_days = round($datediff / (60 * 60 * 24), 0);
            $data['user_id'] = auth()->user()->id;
            $data['leave_type'] = $request->leave_type;
            $data['leave_from'] = $request->start_date;
            $data['leave_to'] = $request->end_date;
            $data['task_type'] = $request->task_type;
            $data['task_reason'] = $request->task_reason;
            $data['task_plan'] = $request->task_plan;
            $data['no_of_days'] = $no_of_days + 1;
            $data['reason'] = $request->work_reason;
            $data['status'] = 1;
            $leaveCreate = LeaveApply::create($data);
            /*Email*/
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, auth()->user()->email);
            $user = User::where('id', $leaveCreate->user_id)->first();
            Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leaveCreate, $user));
            // \Mail::to('ragavi7810@gmail.com')->cc($mail)->send(new Leave($leaveCreate, $user));;

            return redirect()->route('leave.index')->withSuccess('Work from home applied successfully.');
        }
    }

    public function edit($id)
    {
        try {
            $leave = LeaveApply::findOrFail($id);
            if (auth()->user()->id == $leave->user_id && $leave->status == 1) {
                return view('admin.leave.edit')->with(['leave' => $leave]);
            } else {
                return abort(404);
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('leave.index')->withError('Leave not found by ID ' . $id);
        }
    }

    public  function  update(Request $request, $id)
    {
        if ($request->leave_type == 1) {
            $validator = Validator::make($request->all(), [
                'leave_start_date' => 'required|date',
                'leave_end_date' => 'required|date|after_or_equal:leave_start_date',
                'leave_reason' => 'required|min:1|max:300',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $now = strtotime($request->leave_start_date); // or your date as well
            $your_date = strtotime($request->leave_end_date);
            $datediff =  $your_date - $now;

            $no_of_days = round($datediff / (60 * 60 * 24), 0);


            $data['user_id'] = auth()->user()->id;
            $data['leave_type'] = $request->leave_type;
            $data['leave_from'] = $request->leave_start_date;
            $data['leave_to'] = $request->leave_end_date;
            $data['no_of_days'] = $no_of_days + 1;
            $data['reason'] = $request->leave_reason;
            $data['status'] = 1;
            $leave = LeaveApply::find($id);
            $leave->update($data);
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, auth()->user()->email);
            $user = User::where('id', $leave->user_id)->first();
            Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leave, $user));
            return redirect()->route('leave.index')->withSuccess('Leave applied (updated) successfully.');
        }
        if ($request->leave_type == 4) {

            $validator = Validator::make($request->all(), [
                'half_leave_date' => 'required|date|',
                'half_leave_reason' => 'required|min:1|max:300'
            ], [
                'half_leave_date.required' => "Date field is required.",
                'half_leave_reason.required' => "Reason field is required.",
                'half_leave_reason.max' => 'The reason may not be greater than 300 characters.',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['user_id'] = auth()->user()->id;
            $data['leave_type'] = $request->leave_type;
            $data['leave_from'] = $request->half_leave_date;
            $data['leave_to'] = $request->half_leave_date;
            $data['no_of_days'] = "Half Day";
            $data['reason'] = $request->half_leave_reason;
            $data['status'] = 1;
            $leave = LeaveApply::find($id);
            $leave->update($data);
            /*Email*/
            $user = User::where('id', $leave->user_id)->first();
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, auth()->user()->email);
            Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leave, $user));
            return redirect()->route('leave.index')->withSuccess('Half day leave (updated) successfully.');
        }
        if ($request->leave_type == 2) {
            $validator = Validator::make($request->all(), [
                'start_time' => 'required',
                'end_time' => 'required',
                'reason' => 'required|min:1|max:300',
            ]);
            $difference = '';
            if ($request->start_time != '' && $request->end_time != '') {
                $time1 = strtotime($request->start_time);
                $time2 = strtotime($request->end_time);
                $difference = round(abs($time2 - $time1) / 3600);
            }
            if ($difference > 2) {
                $validator->getMessageBag()->add('end_time', 'Please select below 2 hours. Allowed time limit is 2 Hours');
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data['user_id'] = auth()->user()->id;
            $data['leave_type'] = $request->leave_type;
            $data['leave_from'] = $request->start_time;
            $data['leave_to'] = $request->end_time;
            $data['reason'] = $request->reason;
            $data['status'] = 1;
            $leave = LeaveApply::find($id);
            $leave->update($data);
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, auth()->user()->email);
            $user = User::where('id', $leave->user_id)->first();
            Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leave, $user));
            return redirect()->route('leave.index')->withSuccess('Permission applied (updated) successfully.');
        }
        if ($request->leave_type == 3) {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'start_date'  => 'required|date|',
                'end_date'    => 'required|date|after_or_equal:start_date',
                'work_reason'      => 'required|min:1|max:300',
                'task_type'   => 'required',
                'task_reason' => 'required|min:1|max:300',
                'task_plan'   => 'required',
            ], [
                'task_reason.required' => 'Please specify the reason.',
                'task_plan.required' => 'Work plan is required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $now = strtotime($request->start_date);
            $your_date = strtotime($request->end_date);
            $datediff =  $your_date - $now;
            $no_of_days = round($datediff / (60 * 60 * 24), 0);
            $data['user_id'] = auth()->user()->id;
            $data['leave_type'] = $request->leave_type;
            $data['leave_from'] = $request->start_date;
            $data['leave_to'] = $request->end_date;
            $data['task_type'] = $request->task_type;
            $data['task_reason'] = $request->task_reason;
            $data['task_plan'] = $request->task_plan;
            $data['no_of_days'] = $no_of_days + 1;
            $data['work_reason'] = $request->reason;
            $data['status'] = 1;
            $leave = LeaveApply::find($id);
            dd($data);
            $leave->update($data);
            /*Email*/
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, auth()->user()->email);
            $user = User::where('id', $leave->user_id)->first();
            Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leave, $user));

            //Mail::to(reportingEmail($user->reporting_to))->cc('markkeny93@gmail.com')->send(new Leave($leaveCreate, $user));

            return redirect()->route('leave.index')->withSuccess('Work from home applied (updated) successfully.');
        }
    }

    public function destroy($id)
    {
        try {
            $leave = LeaveApply::findOrFail($id);
            if (auth()->user()->id == $leave->user_id) {
                if ($leave->leave_type == 1 && $leave->status == 1) {
                    $leave->delete();
                    return redirect()->route('leave.index')->withSuccess('Leave applied (deleted) successfully.');
                } elseif ($leave->leave_type == 2) {
                    $leave->delete();
                    return redirect()->route('leave.index')->withSuccess('Permission applied (deleted) successfully.');
                } elseif ($leave->leave_type == 3) {
                    $leave->delete();
                    return redirect()->route('leave.index')->withSuccess('WFH applied (deleted) successfully.');
                } elseif ($leave->leave_type == 4) {
                    $leave->delete();
                    return redirect()->route('leave.index')->withSuccess('Half day leave applied (deleted) successfully.');
                }
            } else {
                return abort(404);
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('leave.index')->withError('Employee not found by ID ' . $id);
        }
    }

    public function show($id)
    {
        try {
            $leave = LeaveApply::findOrFail($id);
            $user = User::where('id', $leave->user_id)->first();
            $reportingTo = reportingName($user->reporting_to);
            $reportingEmail = reportingEmail($user->reporting_to);
            if (auth()->user()->id == $leave->user_id || auth()->user()->id == $user->reporting_to || loginUserRole(auth()->user()->id) == 'Super Admin') {
                return view('admin.leave.show')->with(['leave' => $leave, 'reportingTo' => $reportingTo, 'reportingEmail' => $reportingEmail]);
            } else {
                return abort(404);
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('leave.index')->withError('Employee not found by ID ' . $id);
        }
        return view('admin.leave.show')->with(['leave' => $leave]);
    }

    public function statusChange(Request $request, $id)
    {
        try {

            $leave = LeaveApply::findOrFail($id);

            $leave->update(['status' => $request->status, 'status_reason' => $request->status_reason]);
            /*Email*/
            $user = User::where('id', $leave->user_id)->first();

            $userMail = reportingEmail($leave->user_id);
            $mail = explode(',', setting('admin_notification'));
            array_push($mail, reportingEmail($user->reporting_to));

            // Mail::to(reportingEmail($user->reporting_to))->cc($mail)->send(new Leave($leave, $user));

            Mail::to($userMail)->cc($mail)->send(new Leave($leave, $user));
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('leave.index')->withError('Employee not found by ID ' . $id);
        }
        if ($request->status == 2) {
            return redirect()->route('leave.show', $id)->withSuccess('Approved successfully.');
        } elseif ($request->status == 3) {
            return redirect()->route('leave.show', $id)->withSuccess('Rejected successfully.');
        }
    }

    public function leaveExport(Request $request)
    {

        return Excel::download(new LeaveExport($request->all()), 'Leavereport_' . date('d-m-Y') . '.xlsx');
    }
}
