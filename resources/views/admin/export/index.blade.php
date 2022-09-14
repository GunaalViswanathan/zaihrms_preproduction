<!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>
    <title>zaigo - payslip</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
</style>
</head>
<body class="">

<table border="0" cellpadding="0" cellspacing="0" style="font-family: 'Roboto', sans-serif;width:750px; margin:0 auto;  padding:15px;">
    <tr>
        <td style="font-family: 'Roboto', sans-serif;width:100%; margin:0 auto;">
            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                <tr>
                    <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;">

                        <p><img style="width:250px;" src="{{asset('images/zaigo-logo.png')}}"/></p>
                        <p style="width:350px; margin:0 auto; line-height:22px;">
                            <strong>Zaigo Infotech Software Solutions (Pvt) Ltd.</strong><br>
                            6A Sapna Trade Centre, 135, Old 109, <br>Poonamallee High Rd, Egmore, Chennai, <br>Tamil Nadu 600084
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="font-family: 'Roboto', sans-serif;width:100%; margin:0 auto;">
            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                <tr>
                    <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                        <h4 style="color:#000;font-size:20px;text-align:center; margin:10px 0;">Payslip for the month of {{$payroll['month']}}, {{$payroll['year']}}</h4>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td border="0" style="font-family: 'Roboto', sans-serif;width:100%; margin:0 auto;">
            <table cellpadding="0" cellspacing="0" style="width:100%;line-height:25px;border:1px solid #000;">
                <tr>
                    <td width="50%" border="0" cellpadding="0" cellspacing="0" style="text-align:center; ">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;border-right:1px solid #000;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">Name:</td>
                                            <td>{{$employee->full_name}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Designation:</td>
                                             @forelse($employee->userExperience as $experience)
                                                <td>{{$experience->designation}}</td>
                                            @empty
                                                <p>{{'-NA-'}}</p>
                                                @endforelse
                                        </tr>
                                        <tr>
                                            <td width="50%">Location:</td>
                                            <td>{{$employee->userProfile->permanent_address ? $employee->userProfile->permanent_address : '- NA -'}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">LOP:</td>
                                            <td>{{$payroll['lop']}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">Employee ID:</td>
                                            <td>{{"EMP-".$employee->id}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Bank Name:</td>
                                            <td>{{ $employee->userProfile ? $employee->userProfile->bank_name : '- NA -' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Bank Account Number:</td>
                                            <td>{{ $employee->userProfile ? $employee->userProfile->account_number : '- NA -' }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">PAN:</td>
                                            <td>{{$employee->userProfile->pan_number ? $employee->userProfile->pan_number :"-NA-"}}</td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td border="0" style="font-family: 'Roboto', sans-serif;width:100%; margin:0px auto;">
            <table cellpadding="0" cellspacing="0" style="width:100%;border:1px solid #000;border-bottom:none;line-height:25px; margin-top:20px;">
                <tr>
                    <td width="50%" border="0" cellpadding="0" cellspacing="0" style="text-align:center; ">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;border-right:1px solid #000;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">Earnings</td>
                                            <td>Amount</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">Deductions</td>
                                            <td>Amount</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td border="0" style="font-family: 'Roboto', sans-serif;width:100%; margin:15px auto;">
            <table cellpadding="0" cellspacing="0" style="width:100%;border:1px solid #000;line-height:25px; margin-top:0px;">
                <tr>
                    <td width="50%" border="0" cellpadding="0" cellspacing="0" style="text-align:center; ">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;border-right:1px solid #000;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">Basic:</td>
                                            <td><i class="fa fa-inr" ></i> {{$payroll['basic']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">HRA:</td>
                                            <td><i class="fa fa-inr"></i> {{$payroll['hra']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Telephone Reimbursements:</td>
                                            <td><i class="fa fa-inr" ></i> {{$payroll['telephone_reimbursements']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Bonus:</td>
                                            <td><i class="fa fa-inr" ></i> {{$payroll['bonus']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">LTA:</td>
                                            <td><i class="fa fa-inr" ></i> {{$payroll['lta']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Special Allowance:</td>
                                            <td><i class="fa fa-inr" ></i> {{$payroll['spcl_allowance']}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">Income Tax :</td>
                                            <td><i class="fa fa-inr" ></i> {{$payroll['income_tax']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Provident Fund:</td>
                                            <td><i class="fa fa-inr" ></i> {{$payroll['provident_fund']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Professional Tax:</td>
                                            <td><i class="fa fa-inr" ></i> {{$payroll['professional_tax']}}</td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td border="0" style="font-family: 'Roboto', sans-serif;width:100%; margin:0px auto;">
            <table cellpadding="0" cellspacing="0" style="width:100%;border:1px solid #000;border-top:none;line-height:25px; margin-bottom:20px;">
                <tr>
                    <td width="50%" border="0" cellpadding="0" cellspacing="0" style="text-align:center; ">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;border-right:1px solid #000;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">Total Earnings</td>
                                            <td><i class="fa fa-inr" ></i> {{$totalEarning}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">Total Deductions</td>
                                            <td><i class="fa fa-inr" ></i> {{$totalDeduction}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td border="0" style="font-family: 'Roboto', sans-serif;width:100%; margin:0px auto;">
            <table cellpadding="0" cellspacing="0" style="width:100%;line-height:25px; margin-bottom:20px;">
                <tr>
                    <td width="100%" border="0" cellpadding="0" cellspacing="0" style="text-align:center; ">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center; padding:10px 0;">
                                    <table width="100%">
                                        <tr>
                                            <td width="100%" style="text-align:left;">Net pay for the month <strong><i class="fa fa-inr"></i> {{$netPay}} ({{$netPayInWords}})</strong></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="100%" border="0" cellpadding="0" cellspacing="0" style="text-align:center; border-top:2px solid #ccc;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0" style="text-align:center;">
                                    <table width="100%">
                                        <tr>
{{--                                            <td width="100%" style="text-align:center;">This is a system generated payslip and does not require signature.</td>--}}
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>

</html>
