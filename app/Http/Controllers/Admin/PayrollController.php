<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HolidayRequest;
use App\Http\Requests\Admin\PayslipRequest;
use App\Models\Employee;
use App\Models\Payslips;
use App\Models\User;
use App\Services\EmployeeService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LaraSnap\LaravelAdmin\Models\UserProfile;
use LaraSnap\LaravelAdmin\Traits\Upload;
use PDF;

class PayrollController extends Controller
{
    use Upload;
    private $employeeServices;

    public function __construct(EmployeeService $employeeServices)
    {
        $this->employeeServices= $employeeServices;
    }

    public function index(Request $request){
        if(!(userHasRole('employee'))){
        setCurrentListPageURL('payrolls');
        $filter_request=$this->employeeServices->filterValue($request);
        $employee=$this->employeeServices->index($filter_request);
        $role=loginUserRole(auth()->user()->id);
        return view('admin.payroll.index')->with(['employees'=>$employee])->with('filters',$filter_request);
    }
        else{
        $role=auth()->user()->id;
        $payrolls = Payslips::where('employee_id',$role)->paginate(setting('entries_per_page'));
        $employee = User::find($role);
        return view('admin.payroll.list')->with(['payrolls'=>$payrolls , 'employees'=>$employee]);
        }
    }

    public function payslipgenerate(PayslipRequest $request) {
//        check if alrady generated payslip for that month
        $payslips=Payslips::where("employee_id",larasnapDecrypt($request->employee_id))->where('month',$request->month)->where('year',$request->year)->first();
        if($payslips){
            return redirect()->back()->withError('Already Payslip has been generated for this month')->withInput();
        }
    $data['month']=$request->month;
    $data['year']=$request->year;
    $data['employee_id']=larasnapDecrypt($request->employee_id);

        /* handle if file uploaded*/
        if ($request->has('payslip')) {
            $file = $request->file('payslip');
            $folder = config('larasnap.uploads.payslip.path');
            $prefix='payslip_'.$data['month'];
            $fileName = $this->upload($file, $folder, $prefix, larasnapEncrypt($data['employee_id']));
            $data['filename']  = $fileName;
        }

    $payslip=Payslips::create($data);

    return  redirect()->route('payrolls.index')->withSuccess('Payslip Generated Successfully');

    }
    public function create($id){
        $employee=User::find($id);
        return view('admin.payroll.create')->with('employee',$employee);
    }

    public function getpayslip(Request $request){

        $validated = $request->validate([
            'employee' => 'required',
        ]);
        $id=$request->employee;
        $payrolls = Payslips::where('employee_id',$id)->paginate(setting('entries_per_page'));
        $employee = User::find($id);
        if($payrolls->isEmpty()){
            return view('admin.payroll.create')->with('employee',$employee);
        }
        return view('admin.payroll.paysliplist', compact(['employee','payrolls']));
    }

//    public function genereatepdf(Request $request,$id){
//        define("DOMPDF_ENABLE_REMOTE", false);
//        $employee=User::find($id);
//        $totalEaring=$request->basic+$request->hra+$request->telephone_reimbursements+$request->bonus+$request->lta+$request->spcl_allowance;
//        $toalDeduction=$request->income_tax+$request->provident_fund+$request->professional_tax;
//        $netPay=$totalEaring-$toalDeduction;
//        $data['payroll']=$request->all();
//        $data['employee']=$employee;
//        $data['totalEarning']=number_format($totalEaring);
//        $data['totalDeduction']=number_format($toalDeduction);
//        $data['netPay']=number_format($netPay);
//        $data['netPayInWords']=$this->number_to_words($netPay);
//       $pdf=PDF::setOptions([ 'isRemoteEnabled' => true])->loadView(' admin.export.index',$data);
//        return $pdf->download('payslip.pdf');
//
//    }
//
//    public function number_to_words($Number){
//        $number = $Number;
//        $no = floor($number);
//        $point = round($number - $no, 2) * 100;
//        $hundred = null;
//        $digits_1 = strlen($no);
//        $i = 0;
//        $str = array();
//        $words = array('0' => '', '1' => 'one', '2' => 'two',
//            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
//            '7' => 'seven', '8' => 'eight', '9' => 'nine',
//            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
//            '13' => 'thirteen', '14' => 'fourteen',
//            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
//            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
//            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
//            '60' => 'sixty', '70' => 'seventy',
//            '80' => 'eighty', '90' => 'ninety');
//        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
//        while ($i < $digits_1) {
//            $divider = ($i == 2) ? 10 : 100;
//            $number = floor($no % $divider);
//            $no = floor($no / $divider);
//            $i += ($divider == 10) ? 1 : 2;
//            if ($number) {
//                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
//                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
//                $str [] = ($number < 21) ? $words[$number] .
//                    " " . $digits[$counter] . $plural . " " . $hundred
//                    :
//                    $words[floor($number / 10) * 10]
//                    . " " . $words[$number % 10] . " "
//                    . $digits[$counter] . $plural . " " . $hundred;
//            } else $str[] = null;
//        }
//        $str = array_reverse($str);
//        $result = implode('', $str);
//        $points = ($point) ?
//            "." . $words[$point / 10] . " " .
//            $words[$point = $point % 10] : '';
//        return $result . "Rupees  " . $points . "";
//    }



}
