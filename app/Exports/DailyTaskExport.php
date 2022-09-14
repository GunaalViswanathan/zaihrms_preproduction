<?php

namespace App\Exports;

use App\Models\DailyReport;
use App\Models\User;
use LaraSnap\LaravelAdmin\Models\Role;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
Use Maatwebsite\Excel\Sheet;

class DailyTaskExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    use Exportable;
    public $val;

    public function __construct($request)
    {
        $this->val = $request;
    }
    public function collection()
    {
        $val = $this->val;
        if (strtolower(loginUserRole(auth()->user()->id)) != 'employee') {
            $dailyReport = DailyReport::select('id', 'user_id', 'project_id', 'task_description', 'worked_hours', 'date')->where('project_id', $this->val['id']);
        } else {
            $dailyReport = DailyReport::select('id', 'user_id', 'project_id', 'task_description', 'worked_hours', 'date')->where('project_id', $this->val['id'])->where('user_id', auth()->user()->id);
        }

        if ($this->val['from_date'] != '') {
            $dailyReport->whereDate('date', '>=', dateFormat($this->val['from_date']));
        }
        if ($this->val['to_date'] != '') {
            $dailyReport->whereDate('date', '<=', dateIncludeDays($this->val['to_date'], 0));
        }
        if ($this->val['sort_by'] != '') {
            $dailyReport->orderBy('id', $this->val['sort_by']);
        } else {
            $dailyReport->orderByDesc('id');
        }
        if ($this->val['user_id'] != '') {
            $dailyReport->where('user_id', $this->val['user_id']);
        }

        $dailyReport = $dailyReport->get();

        $dailyTaskReport = [];
        $temp = [];
        $temp[] = 'S.No';
        if (strtolower(loginUserRole(auth()->user()->id)) != 'employee') {
            $temp[] = 'Resource Name';
        }
        $temp[] = 'Task Date';
        $temp[] = 'Task Description';
        $temp[] = 'Hours Worked';
        array_push($dailyTaskReport, $temp);
        $s = 1; $totalsum = 0;
        foreach ($dailyReport as $detail) {
            $totalsum += $detail->worked_hours;
            $temp = [];
            $temp['s.no'] = $s++;
            if (strtolower(loginUserRole(auth()->user()->id)) != 'employee') {
                $temp['name'] = reportingName($detail->user_id);
            }
            $temp['task_date'] = date(setting('date_format'), strtotime($detail->date));
            $temp['task_description'] = ucwords($detail->task_description);
            $temp['worked_hours'] = $detail->worked_hours;
            array_push($dailyTaskReport, $temp);
        }
        $temp = [];
        $temp[] = '';
        if (loginUserRole(auth()->user()->id) != 'Employee') {
            $temp[] = '';
        }
        $temp[] = '';
        $temp[] = 'Total Hours Worked';
        $temp[] = number_format($totalsum);
        array_push($dailyTaskReport, $temp);
        return collect($dailyTaskReport);
    }

    public function headings(): array
    {
        return [

        ];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                    
                if (strtolower(loginUserRole(auth()->user()->id)) != 'employee') {
                    $cellRange = 'A1:E1'; // All headers
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);

                    Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
                        $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
                    });

                    $event->sheet->getStyle('A1:E1')->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('d8c69aa6');

                    $event->sheet->styleCells(
                        'A1:E1',
                        [
                            'font' => array(
                                'name'      =>  'Calibri',
                                'size'      =>  12,
                                'color' => ['argb' => 'FFFFFF'],
                            )
                        ]
                    );
                } else {
                    $cellRange = 'A1:D1'; // All headers
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);

                    Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
                        $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
                    });

                    $event->sheet->getStyle('A1:D1')->getFill()
                      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                      ->getStartColor()->setARGB('d8c69aa6');

                    $event->sheet->styleCells(
                        'A1:D1',
                        [
                            'font' => array(
                                'name'      =>  'Calibri',
                                'size'      =>  12,
                                'color' => ['argb' => 'FFFFFF'],
                            )
                        ]
                    );
                }
            },
        ];
    }
}
