<?php

namespace App\Console\Commands;

use App\Mail\Leave;
use App\Mail\reminder_mail;
use Illuminate\Console\Command;
use App\Models\Report;
use App\Models\User;
use App\Models\Reminder;
use App\Models\LeaveApply;
use App\Models\Holidays;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\Role;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class ProjectReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Request $request)
    {
        $report = Report::whereDate('date', Carbon::yesterday())->pluck('user_id')->toArray();
        if (count($report) != 0) {
            // dd('yes');
            //            DB::enableQueryLog();
            $role  = Role::where('name', 'employee')->first();
            $exceptUsers = Role::where('name', 'super-admin')->first();
            $users = User::whereHas('user_role', function ($query) use ($role, $report, $exceptUsers) {
                $query->where('role_id', $role->id);
                $query->whereNotIn('user_id', $report);
                $query->where('reporting_to', '!=', $exceptUsers->id);
                $query->where('status','!=','0');
            })->get();
            //            dd($query = DB::getQueryLog());
            //  $this->info($users);
        } else {
            // dd('no');
            //            DB::enableQueryLog();
            $role  = Role::where('name', 'employee')->first();
            $exceptUsers = Role::where('name', 'super-admin')->first();
            $users = User::whereHas('user_role', function ($query) use ($role, $exceptUsers) {
                $query->where('role_id', $role->id);
                $query->where('reporting_to', '!=', $exceptUsers->id);
                $query->where('status','!=','0');
            })->get();
            //            dd($query = DB::getQueryLog());
        }
        // $this->info($users);
        $mail = explode(',', setting('admin_notification'));
        if (($exceptMail = array_search(config('larasnap.mod
        ule_list.hr'), $mail)) !== false) {
            unset($mail[$exceptMail]);
        }
        // deleting the record after submitted their report 
        $get_record_dates = Report::whereDate('created_at', Carbon::yesterday())->get();
        foreach ($get_record_dates as $get_record_date) {
            $reminder_record_date = Reminder::where('reminder_date', $get_record_date->date)
                ->where('user_id', $get_record_date->user_id)
                ->delete();
        }
        foreach ($users as $user) {
            $reminder = new Reminder;
            $yesterday = dateFormat(Carbon::yesterday(), 'Y-m-d');
            $leaveEmployee = LeaveApply::where('status', '2')
                ->whereRaw('"' . $yesterday . '" between `leave_from` and `leave_to`')
                ->where('user_id', $user->id)->get();
            $exceptHoliday = Holidays::where('holiday_date', dateFormat(Carbon::yesterday(), 'Y-m-d'))->get();
            if (count($leaveEmployee) > 0 || count($exceptHoliday) > 0) {
                continue;
            }
            $reminder->user_id = $user->id;
            $reminder->reminder_date = dateFormat(Carbon::yesterday(), 'Y-m-d');
            $reminder->save();
            $resourceCount = Reminder::Where('user_id', $user->id)->count();
            if ($resourceCount == 1 || $resourceCount == 2) {
                \Mail::to($user->email)->cc(reportingEmail($user->reporting_to))->send(new \App\Mail\reminder_mail($reminder, $resourceCount));
                // \Mail::to($user->email)->cc('ragavi@zaigoinfotech.com')->send(new \App\Mail\reminder_mail($reminder,$resourceCount));
            } elseif ($resourceCount >= 3) {
                array_push($mail, reportingEmail($user->reporting_to));
                \Mail::to($user->email)->cc($mail)->send(new \App\Mail\reminder_mail($reminder, $resourceCount));
                if (($exceptMail = array_search(reportingEmail($user->reporting_to), $mail)) !== false) {
                    unset($mail[$exceptMail]);
                }
            } 
        }
    }
}
