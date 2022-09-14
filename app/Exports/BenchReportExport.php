<?php

namespace App\Exports;

use App\Models\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class BenchReportExport implements FromView
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
        if ($this->val['resource'] != '') {
            $report->where('user_id', $val);
        }
        $report->whereNull('project_id');
        $report = $report->get();
        return view('admin.project.bench.bench_report_excel', ['users' => $report, 'val' => $this->val]);
    }

}
