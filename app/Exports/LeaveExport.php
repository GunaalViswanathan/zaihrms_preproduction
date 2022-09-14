<?php

namespace App\Exports;

use App\Models\LeaveApply;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class LeaveExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    use Exportable;
    public $val;

    public function __construct($request)
    {
        $this->val = $request;
    }
    public function collection()
    {

        if (strtolower(loginUserRole(auth()->user()->id)) == 'employee') {
            $leave = LeaveApply::where('user_id', auth()->user()->id);
        } else {
            $leave = LeaveApply::select('id', 'user_id', 'leave_type', 'leave_from', 'leave_to', 'permission_from', 'permission_to', 'no_of_days', 'reason', 'status', 'created_at', 'task_type', 'task_reason', 'task_plan');
        }

        if ($this->val['sort_by'] != '') {
            $leave->orderby('id', ($this->val == 'latestfirst') ? 'desc' : 'asc');
        } else {
            $leave->orderByDesc('id');
        }
        /*Date Filter*/
        if ($this->val['from_date'] != '') {
            $leave->whereDate('leave_from', '>=', dateFormat($this->val['from_date']));
        }
        if ($this->val['to_date'] != '') {
            $leave->whereDate('leave_to', '<=', dateIncludeDays($this->val['to_date'], 0));
        }
        if (strtolower(loginUserRole(auth()->user()->id)) == 'employee') {
            if ($this->val['user_id'] != '') {
                $leave->where('user_id', '=', auth()->user()->id);
                // dd($leave);
            }
        } 
        if (strtolower(loginUserRole(auth()->user()->id)) != 'employee') {
        if ($this->val['user_id'] != '') {         
            $leave->where('user_id', '=', $this->val['user_id']);
        }}
        if ($this->val['type'] != '') {
            $leave->where('leave_type', '=', $this->val['type']);
        }
        $leave = $leave->get();

        $leaveReport = [];
        $temp = [];
        $temp[] = 'S.No';
        $temp[] = 'Type';
        if (strtolower(loginUserRole(auth()->user()->id)) != 'employee') {
            $temp[] = 'Name';
        }
        $temp[] = 'From';
        $temp[] = 'To';
        $temp[] = 'Days';
        $temp[] = 'Reason';
        $temp[] = 'Task Type';
        $temp[] = 'Reason for Task Type';
        $temp[] = 'Task Plan';
        $temp[] = 'Status';
        array_push($leaveReport, $temp);
        $s = 1;
        foreach ($leave as $detail) {
            $temp = [];
            $temp['s.no'] = $s++;
            $temp['type'] = $detail->leave_type == 1 ? 'Leave' : ($detail->leave_type == 2 ? 'Permission' : ($detail->leave_type == 4 ? 'Half Day Leave' : 'Work From Home') );
            if (strtolower(loginUserRole(auth()->user()->id)) != 'employee') {
                $temp['name'] = ucwords(reportingName($detail->user_id));
            }
            if ($detail->leave_type == 1 || $detail->leave_type == 3) {
                $temp['from'] = date(setting('date_format'), strtotime($detail->leave_from));
                $temp['to'] = date(setting('date_format'), strtotime($detail->leave_to));
            } elseif ($detail->leave_type == 2) {
                $temp['from'] =  date(setting('date_time_format'), strtotime($detail->leave_from));
                $temp['to'] = date(setting('date_time_format'), strtotime($detail->leave_to));
            }elseif ($detail->leave_type == 4) {
                $temp['from'] =  date(setting('date_format'), strtotime($detail->leave_from));
                $temp['to'] = date(setting('date_format'), strtotime($detail->leave_from));
            }
            if ($detail->leave_type == 1 || $detail->leave_type == 3) {
                $temp['days'] = isset($detail->no_of_days) ? $detail->no_of_days : '- NA -';
            } elseif ($detail->leave_type == 2) {
                $temp['days'] = hourCalculate($detail->leave_from, $detail->leave_to);
            }elseif ($detail->leave_type == 4) {
                $temp['days'] = 'Half Day';
            }

            $temp['reason'] = ucfirst($detail->reason);
            $temp['task_type'] = $detail->task_type != '' ? ($detail->task_type == 1 ? 'Business Critical' : ($detail->task_type == 2 ? 'Time Critical' : 'Both Business Critical & Time Critical')) : '- NA -';
            $temp['task_reason'] = $detail->task_reason != '' ? ucwords($detail->task_reason) : '- NA -';
            $temp['task_plan'] = $detail->task_plan != '' ? ucwords($detail->task_plan) : '- NA -';
            $temp['status'] = $detail->status == 1 ? 'Pending' : ($detail->status == 2 ? 'Approved' : 'Rejected');
            array_push($leaveReport, $temp);
        }
        return collect($leaveReport);
    }

    public function headings(): array
    {
        return [];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:K1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);

                Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
                    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
                });

                $event->sheet->getStyle('A1:K1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('d8c69aa6');

                $event->sheet->styleCells(
                    'A1:K1',
                    [
                        'font' => array(
                            'name'      =>  'Calibri',
                            'size'      =>  12,
                            'color' => ['argb' => 'FFFFFF'],
                        )
                    ]
                );
            },
        ];
    }
}
