@extends('larasnap::layouts.app', ['class' => 'helpdesk-index'])
@section('title','Help Desk')
@section('content')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        /* border: 1px solid #dddddd; */
        text-align: left;
        padding: 8px;
        /* color: black; */
        font-family: Nunito, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #858796;
    }

    tr:nth-child(even) {
        background-color: #576c761a !important
    }

    .title {
        background-color: #222d32 !important;
        border-radius: 0px;
    }

    .white {
        color: white;
    }
</style>
    <!-- Page Heading  Start-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sample Pay Slip</h1>
    </div>
    <div>
        <a style="float: right;" href="{{route('helpdesks.downloadslip')}}" class="btn btn-primary">Download</a>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="payslip-title">Payslip for the month of {{\Carbon\Carbon::now()->format('M')}} {{\Carbon\Carbon::now()->format('Y')}}</h4>
                    <div class="row">
                        <div class="col-sm-6 m-b-20">
                            <img src="{{asset('images/logo.png')}}" width="100px" height="60px" class="inv-logo" alt="">
                            <br>
                            <br>
                            <ul class="list-unstyled mb-0">
                                <li><strong>Zaigo Infotech</strong></li>
                                <li>6A Sapna Trade Centre,</li>
                                <li>135,Old, 109, Poonamallee High Rd,</li>
                                <li>Egmore, Chennai, Tamil Nadu 600084</li>
                            </ul>
                        </div>
                        <div class="col-sm-6 m-b-20">
                            <div class="invoice-details">
                                <h3 class="text-uppercase">Payslip #49029</h3>
                                <ul class="list-unstyled">
                                    <li>Salary Month: <span>{{\Carbon\Carbon::now()->format('M')}}, {{\Carbon\Carbon::now()->format('Y')}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-lg-12 m-b-20">
                            <ul class="list-unstyled">
                                <li>
                                    <h5 class="mb-0"><strong>John Doe</strong></h5>
                                </li>
                                <li><span>Web Designer</span></li>
                                <li>Employee ID: FT-0009</li>
                                <li>Joining Date: 1 Sept 2020</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 column">
                            <div>
                                <h4 class="m-b-10"><strong>Earnings</strong></h4>
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td><strong>Basic Salary</strong> <span class="float-right">Rs.6500</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>House Rent Allowance (H.R.A.)</strong> <span class="float-right">Rs.55</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Conveyance</strong> <span class="float-right">Rs.55</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Other Allowance</strong> <span class="float-right">Rs.55</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Earnings</strong> <span class="float-right"><strong>Rs.55</strong></span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6 column">
                            <div>
                                <h4 class="m-b-10"><strong>Deductions</strong></h4>
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr><td><strong>Tax Deducted at Source (T.D.S.)</strong> <span class="float-right">Rs.0</span></td></tr>
                                    <tr><td><strong>Provident Fund</strong> <span class="float-right">Rs.0</span></td></tr>
                                    <tr><td><strong>ESI</strong> <span class="float-right">Rs.0</span></td></tr>
                                    <tr><td><strong>Loan</strong> <span class="float-right">Rs.300</span></td></tr>
                                    <tr><td><strong>Total Deductions</strong> <span class="float-right"><strong>Rs.00</strong></span></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p style="text-align: center"><strong>Net Salary: Rs.59698</strong> (Fifty nine thousand six hundred and ninety eight only.)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
