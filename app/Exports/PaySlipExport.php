<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use PHPUnit\TextUI\Help;
use Illuminate\Contracts\View\View;

class PaySlipExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.export.index', [
            'employee' => User::all()
        ]);
    }
}
