<?php

namespace App\Exports;

use App\Models\LeaveApply;
use App\Models\User;
use LaraSnap\LaravelAdmin\Models\Role;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class EmployeeExport implements FromCollection, WithHeadings,WithColumnFormatting,WithColumnWidths

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
        $role  = Role::where('name', 'employee')->first();
            $user = User::whereHas('user_role', function ($query) use ($role){ $query->where('role_id', $role->id); })->whereHas('userProfile', function ($query) use ($val){ $query->whereRaw("(first_name like '%".$val['search']."%' OR last_name like '%".$val['search']."%' OR email like '%".$val['search']."%' OR mobile_no like '%".$val['search']."%')"); });

        if ($this->val['sort_by'] != '') {
            if ($this->val['sort_by'] == 'latestfirst') {
                $user->orderByDesc('id');
            }
        } else {
            $user->orderby('id', 'asc');
        }

        if ($this->val['user_status'] != 'all') {
            $user->where('status', '=', $this->val['user_status']);
        }

        if ($this->val['reporting_to'] != '') {
            $user->where('reporting_to', '=', $this->val['reporting_to']);
        }
        $user = $user->get();

        $empReport = [];
        $temp = [];
        $temp[] = 'S.No';
        $temp[] = 'Name';
        $temp[] = 'Official Email Address';
        $temp[] = 'Personal Email Address';
        $temp[] = 'Mobile Number';
        $temp[] = 'Reporting';
        $temp[] = 'Status';
        $temp[] = 'Emergency/Alternate Number';
        $temp[] = 'Date of Birth';
        $temp[] = 'Permanent Address';
        $temp[] = 'Residential Address';
        $temp[] = 'Blood Group';
        $temp[] = 'Aadhar Number';
        $temp[] = 'PAN Number';
        $temp[] = 'Bank Name';
        $temp[] = 'Account Number';
        $temp[] = 'IFSC Code';
        $temp[] = 'Account Holder Name';
        array_push($empReport, $temp);
        $s = 1;
        foreach ($user as $detail) {
            $temp = [];
            $temp['s.no'] = $s++;
            $temp['name'] = $detail->userProfile ? ucwords($detail->userProfile->first_name).' '. ucwords($detail->userProfile->last_name) : '- NA -';
            $temp['email'] = $detail->email;
            $temp['personal_email'] = $detail->userProfile->personal_email ? $detail->userProfile->personal_email : '- NA -';
            $temp['mobile_no'] = $detail->userProfile->mobile_no ? $detail->userProfile->mobile_no : '- NA -';
            $temp['reporting_to'] = ucwords(reportingName($detail->reporting_to));
            $temp['status'] = $detail->status_info;
            $temp['alternate'] = $detail->userProfile->alternate_mobile_number ? $detail->userProfile->alternate_mobile_number : '- NA -';
            $temp['dob'] = $detail->userProfile->dob ? $detail->userProfile->dob : '- NA -';
            $temp['permanent_address'] = $detail->userProfile->permanent_address ? $detail->userProfile->permanent_address : '- NA -';
            $temp['residential_address'] = $detail->userProfile->residential_address ? $detail->userProfile->residential_address : '- NA -';
            $temp['blood_group'] = $detail->userProfile->blood_group ? $detail->userProfile->blood_group : '- NA -';
            $temp['aadhar_number'] = "'".$detail->userProfile->aadhar_number ? $detail->userProfile->aadhar_number : '- NA -'."'";
            $temp['pan_number'] = $detail->userProfile->pan_number ? $detail->userProfile->pan_number : '- NA -';
            $temp['bank_name'] = $detail->userProfile->bank_name ? $detail->userProfile->bank_name : '- NA -';
            $temp['account_number'] = $detail->userProfile->account_number ? $detail->userProfile->account_number : '- NA -';
            $temp['ifsc_code'] = $detail->userProfile->ifsc_code ? $detail->userProfile->ifsc_code : '- NA -';
            $temp['holder_name'] = $detail->userProfile->holder_name ? $detail->userProfile->holder_name : '- NA -';
            array_push($empReport, $temp);
        }
        return collect($empReport);
       
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
    public function columnFormats(): array
    {
        return [
            'L' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 45, 
            'C' => 45,
            'D' => 45,
            'E' => 45, 
            'F' => 45,
            'G' => 20,
            'H' => 45, 
            'I' => 45,
            'J' => 45,
            'K' => 45, 
            'L' => 45,
            'M' => 20,
            'N' => 45, 
            'O' => 45,
            'P' => 45,
            'Q' => 45, 
            'R' => 45,   

        ];
    }
    
}

