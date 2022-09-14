@extends('larasnap::layouts.app', ['class' => 'leave-show'])
@section('title','Leave | Permission')
@section('content')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
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
    <h1 class="h3 mb-0 text-gray-800">@if($leave->leave_type == 1) Leave Detail @elseif($leave->leave_type == 2) Permission Detail  @elseif($leave->leave_type == 4) Half Day Leave Detail @else Work From Home Detail @endif</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <a href="{{ route('leave.index') }}" title="Back to List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to List
                    </a>
                    <br> <br>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="details mb-10">
                                <tr>
                                    <td><b>Name of the Employee</b></td>
                                    <td>{{ ucwords(reportingName($leave->user_id)) }}</td>
                                </tr>
                                @if($leave->leave_type == 1)
                                <tr>
                                    <td><b>Leave Applied Date</b></td>
                                    <td>{{ date(setting('date_format'),strtotime($leave->created_at))}}</td>
                                </tr>
                                <tr>
                                    <td><b>Leave Required From</b></td>
                                    <td> {{ date(setting('date_format'), strtotime($leave->leave_from)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Leave Required To </b></td>
                                    <td> {{ date(setting('date_format'), strtotime($leave->leave_to)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Reporting To</b></td>
                                    <td> {{$reportingTo}}</td>
                                </tr>
                                <tr>
                                    <td><b>Reporting Email</b></td>
                                    <td> {{$reportingEmail}}</td>
                                </tr>
                                <tr>
                                    <td><b>Reason For The Leave</b></td>
                                    <td>{{ ucfirst($leave->reason) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Status</b></td>
                                    <td>{{ $leave->status == 1 ? 'Pending' : ($leave->status == 2 ? 'Approved' : 'Rejected') }}</td>
                                </tr>
                                @if($leave->status_reason != "")
                                <tr class = "reason">
                                    <td><b>Reason For The Status</b></td>
                                    <td>{{ucfirst($leave->status_reason)}}</td>
                                </tr>
                                @endif
                                @elseif($leave->leave_type == 2)
                                <tr>
                                    <td><b>Permission Applied Date</b></td>
                                    <td>{{ date(setting('date_format'),strtotime($leave->created_at))}}</td>
                                </tr>
                                <tr>
                                    <td><b>Permission Required Date From </b></td>
                                    <td> {{ date(setting('date_format'), strtotime($leave->leave_from)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Permission Required From</b></td>
                                    <td> {{ date(setting('time_format'), strtotime($leave->leave_from)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Permission Required To</b></td>
                                    <td> {{ date(setting('time_format'), strtotime($leave->leave_to)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Reporting To</b></td>
                                    <td> {{$reportingTo}}</td>
                                </tr>
                                <tr>
                                    <td><b>Reporting Email</b></td>
                                    <td> {{$reportingEmail}}</td>
                                </tr>
                                <tr>
                                    <td><b>Reason</b></td>
                                    <td>{{ ucfirst($leave->reason) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Status</b></td>
                                    <td>{{ $leave->status == 1 ? 'Pending' : ($leave->status == 2 ? 'Approved' : 'Rejected') }}</td>
                                </tr>
                                @if($leave->status_reason != "")
                                <tr class = "reason">
                                    <td><b>Reason For The Status</b></td>
                                    <td>{{ucfirst($leave->status_reason)}}</td>
                                </tr>
                                @endif
                                @endif
                                @if($leave->leave_type == 3)
                                <tr>
                                    <td><b>WFH Applied Date</b></td>
                                    <td>{{ date(setting('date_format'),strtotime($leave->created_at))}}</td>
                                </tr>
                                <tr>
                                    <td><b>WFH Required From</b></td>
                                    <td> {{ date(setting('date_format'), strtotime($leave->leave_from)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>WFH Required To</b></td>
                                    <td> {{ date(setting('date_format'), strtotime($leave->leave_to)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Reporting To</b></td>
                                    <td> {{$reportingTo}}</td>
                                </tr>
                                <tr>
                                    <td><b>Reporting Email</b></td>
                                    <td> {{$reportingEmail}}</td>
                                </tr>
                                <tr>
                                    <td><b>Reason</b></td>
                                    <td>{{ ucfirst($leave->reason) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Task Type</b></td>
                                    <td>{{ $leave->task_type == 1 ? 'Business Critical' : ($leave->task_type == 2 ? 'Time Critical' : 'Both Business Critical & Time Critical') }}</td>
                                </tr>
                                <tr>
                                    <td><b>{{ taskType($leave->task_type) }}</b></td>
                                    <td>{{ ucfirst($leave->task_reason) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Work Plan</b></td>
                                    <td>{{ ucfirst($leave->task_plan) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Status</b></td>
                                    <td>{{ $leave->status == 1 ? 'Pending' : ($leave->status == 2 ? 'Approved' : 'Rejected') }}</td>
                                </tr>
                                @if($leave->status_reason != "")
                                <tr class = "reason">
                                    <td><b>Reason For The Status</b></td>
                                    <td>{{ucfirst($leave->status_reason)}}</td>
                                </tr>
                                @endif
                                @endif
                                @if($leave->leave_type == 4)
                                <tr>
                                    <td><b>Leave Applied Date</b></td>
                                    <td>{{ date(setting('date_format'),strtotime($leave->created_at))}}</td>
                                </tr>
                                <tr>
                                    <td><b>Half Day Leave Required From</b></td>
                                    <td> {{ date(setting('date_format'), strtotime($leave->leave_from)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Half Day Leave Required To </b></td>
                                    <td> {{ date(setting('date_format'), strtotime($leave->leave_from)) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Reporting To</b></td>
                                    <td> {{$reportingTo}}</td>
                                </tr>
                                <tr>
                                    <td><b>Reporting Email</b></td>
                                    <td> {{$reportingEmail}}</td>
                                </tr>
                                <tr>
                                    <td><b>Reason</b></td>
                                    <td style="word-wrap: break-word">{{ ucfirst($leave->reason) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Status</b></td>
                                    <td>{{ $leave->status == 1 ? 'Pending' : ($leave->status == 2 ? 'Approved' : 'Rejected') }}</td>
                                </tr>
                                @if($leave->status_reason != "")
                                <tr class = "reason">
                                    <td><b>Reason For The Status</b></td>
                                    <td >{{ucfirst($leave->status_reason)}}</td>
                                </tr>
                                @endif
                                @endif
                            </table>
                        </div>

                        @canAccess('leave.status_update')
                        <div class="col-md-4 text-center">
                            <form method="POST" action="{{ route('leave.status_update', $leave->id) }}" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                                @csrf
                                <div>
                                <label for="status_reason" class="control-label">Reason<small class="text-danger required">*</small></label>
                                <textarea name="status_reason" type="text" id="status_reason" value="{{ old('status_reason') }}" class="form-control"></textarea><br>
                                </div>
                                <input type="hidden" name="status" id="status" value="">
                                <button @if($leave->status == 2) disabled @endif type="submit" title="Approved" class="btn btn-success btn-sm" onclick="statusChange(2)"><i aria-hidden="true" class="fa fa-check"></i> @if($leave->status == 2) Approved @else Approve @endif</button>
                                <button @if($leave->status == 3) disabled @endif type="submit" title="Reject" class="btn btn-danger btn-sm" onclick="statusChange(3)"><i aria-hidden="true" class="fa fa-close"></i> @if($leave->status == 3) Rejected @else Reject @endif</button><br><br>
                            </form>
                        </div>
                        @endcanAccess
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Content End-->
<script>
    function statusChange(a) {
        $('#status').val(a);
    }
</script>
@endsection