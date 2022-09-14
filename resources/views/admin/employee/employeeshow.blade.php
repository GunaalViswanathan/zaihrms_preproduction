@extends('larasnap::layouts.app', ['class' => 'user-show'])
@section('title','My Profile')
@section('content')
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    color: black;
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
        <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
    </div>
    <!-- Page Heading End-->
    <!-- Page Content Start-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <table class="mb-10">
                                    <tr class="title"><td class="white">PERSONAL DETAILS</td><td></td></tr>
                                    <tr><td>Name</td><td>{{ $user->userProfile ? ucwords($user->userProfile->first_name).' '. ucwords($user->userProfile->last_name) : '- NA -' }}</td></tr>
                                    <tr><td>Official Email Address</td><td>{{ $user->email }}</td></tr>
                                    <tr><td>Personal Email Address</td><td>{{ $user->userProfile->personal_email ? $user->userProfile->personal_email : '- NA -'}}</td></tr>
                                    <tr><td>Phone Number</td><td>{{ $user->userProfile->mobile_no ? $user->userProfile->mobile_no : '- NA -' }}</td></tr>
                                    <tr><td>Emergency/Alternate Number</td><td>{{ $user->userProfile->alternate_mobile_number ? $user->userProfile->alternate_mobile_number : '- NA -' }}</td></tr>
                                    <tr><td>Date of Birth</td><td>{{ $user->userProfile->dob ? date(setting('date_format'), strtotime($user->userProfile->dob)) : '- NA -' }}</td></tr>
                                    <tr><td>Permanent Address</td><td>{{ $user->userProfile->permanent_address ? ucwords($user->userProfile->permanent_address) : '- NA -' }}</td></tr>
                                    <tr><td>Residential Address</td><td>{{ $user->userProfile->residential_address ? ucwords($user->userProfile->residential_address) : '- NA -' }}</td></tr>
                                    <tr><td>Blood Group</td><td>{{ $user->userProfile->blood_group ? $user->userProfile->blood_group : '- NA -' }}</td></tr>
                                    <tr><td>Aadhar Number</td><td>{{ $user->userProfile->aadhar_number ? $user->userProfile->aadhar_number : '- NA -' }}</td></tr>
                                    <tr><td>Pan Number</td><td>{{ $user->userProfile->pan_number ? $user->userProfile->pan_number : '- NA -' }}</td></tr>
                                    
                                </table>
                                <table class="mb-10">
                                    <tr class="title"><td class="white">BANK DETAILS</td><td></td></tr>
                                    <tr><td>Bank Name</td><td>{{ $user->userProfile->bank_name ? ucwords($user->userProfile->bank_name) : '- NA -' }}</td></tr>
                                    <tr><td>Account Number</td><td>{{ $user->userProfile->account_number ? $user->userProfile->account_number : '- NA -' }}</td></tr>
                                    <tr><td>IFSC Code</td><td>{{ $user->userProfile->ifsc_code ? $user->userProfile->ifsc_code : '- NA -' }}</td></tr>
                                    <tr><td>Account Holder Name</td><td>{{ $user->userProfile->holder_name ? ucwords($user->userProfile->holder_name) : '- NA -' }}</td></tr>
                                </table>
                                
                                <table class="mb-10">
                                    <tr class="title"><td class="white">FAMILY DETAILS</td><td></td></tr>
                                    <tr><td>Father Name</td><td>{{ $user->userFamily ? ucwords($user->userFamily->father_name) : '- NA -' }}</td></tr>
                                    <tr><td>Mother Name</td><td>{{ $user->userFamily ? ucwords($user->userFamily->mother_name) : '- NA -' }}</td></tr>
                                    <tr><td>Marital Status</td><td>{{ $user->userFamily ? ($user->userFamily->marital_status == 1 ? 'Married' : 'Single') : '- NA -' }}</td></tr>
                                    @if($user->userFamily && $user->userFamily->marital_status == 1)
                                        <tr><td>Date of Married</td><td>{{ $user->userFamily ? $user->userFamily->date_of_married : '- NA -' }}</td></tr>
                                        <tr><td>Spouse Name</td><td>{{ $user->userFamily ? ucwords($user->userFamily->spouse_name) : '- NA -' }}</td></tr>
                                        <tr><td>No of Children</td><td>{{ $user->userFamily ? $user->userFamily->no_of_children : '- NA -' }}</td></tr>
                                    @endif
                                </table>
                                
                                <table class="mb-10">
                                    <tr class="title"><td class="white">EMPLOYEE STATUS</td><td></td></tr>
                                    <tr><td>Status</td><td>{{ $user->status_info }}</td></tr>
                                </table>
                                
                            </div>
                            <div class="col-md-4 text-center">
                                <img src="{{ $user->avatar }}" class="rounded-circle user-photo" alt="Prof Picture" >
                                <div class="text-center mt-3">
                                    <a href="{{ route('profie.update_profile') }}" title="Update Profile" class="btn btn-warning btn-sm"> Update Profile <i aria-hidden="true" class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <strong class="table-heading">EDUCATIONAL DETAILS</strong>
                                <table class="mb-10">
                                    @if($user->userEducation()->exists())
                                        <tr>
                                            <th class="title">Institute</th>
                                            <th class="title">Qualification</th>
                                            <th class="title">Passed Out</th>
                                            <th class="title">Percentage Scored</th>
                                        </tr>
                                    @endif
                                    @forelse($user->userEducation as $detail)
                                        <tr>
                                            <td>{{ ucwords($detail->institute_name) }}</td>
                                            <td>{{ ucwords($detail->qualification) }}</td>
                                            <td>{{ $detail->passing_year }}</td>
                                            <td>{{ $detail->percentage_score }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                No Education detail(s) found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                                <strong class="table-heading">EXPERIENCE DETAILS</strong>
                                <table>
                                    @if($user->userExperience()->exists())
                                        <tr>
                                            <th class="title">Organization</th>
                                            <th class="title">Designation</th>
                                            <th class="title">Period</th>
                                        </tr>
                                    @endif
                                    @forelse($user->userExperience as $detail)
                                        <tr>
                                            <td>{{ ucwords($detail->organization) }}</td>
                                            <td>{{ ucwords($detail->designation) }}</td>
                                            <td>{{ $detail->from_year.' - '.$detail->to_year }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                No Experience Detail(s) Found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            {{--<div class="col-md-4 text-center">
                                <img src="{{ $user->avatar }}" class="rounded-circle user-photo" alt="Prof Picture" >
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content End-->
@endsection
