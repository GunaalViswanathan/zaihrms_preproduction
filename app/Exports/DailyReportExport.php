<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class DailyReportExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public $val;

    public function __construct($request)
    {
        $this->val = $request;
    }
    public function view(): View
    {
        if (!userHasRole('employee')) {
            $val = $this->val['resource'];
        } else {
            $val = Auth::user()->id;
        }
        $report = Report::query();
        if (strtolower(loginUserRole(auth()->user()->id)) != 'employee' && $this->val['project_name']) {
            $report->where('project_id', $this->val['project_name']);
        } elseif($this->val['project_name']) {
            $report->where('project_id', $this->val['project_name'])->where('user_id', auth()->user()->id);
        }
        if ($this->val['from_date'] != '') {
            $report->whereDate('date', '>=', Carbon::parse($this->val['from_date'])->format('Y-m-d'));
        }
        if ($this->val['to_date'] != '') {
            $report->whereDate('date', '<=', Carbon::parse($this->val['to_date'])->format('Y-m-d'));
        }
        if ($this->val['sort_by'] != '') {
            $report->orderBy('id', 'desc');
        } else {
            $report->orderByDesc('id');
        }
        if ($this->val['project_name'] != '') {
            $report->where('project_id', $this->val['project_name']);
        }
        if ($this->val['resource'] != '') {
            $report->where('user_id', $val);
        }
        // if($this->val['project_name']==NULL){
        //   $report->whereNotNULL('project_id');
        // }
        $report=$report->get();
        return view('admin.project.project_report.excel', ['users' => $report, 'val' => $this->val]);
    }

}
