@extends('larasnap::layouts.app', ['class' => 'user-create'])
@section('title','Leave - Permission Management')
@section('content')
<!-- Page Heading  Start-->
<style>
    input[type="radio"] {
        margin-left: 25px;

    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Apply Leave/Permission</h1>
</div>

<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <div class="text-left">
                        <a href="{{ route('leave.index') }}" title="Back to List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to List</a>
                    </div>
                    <br>
                    <form method="POST" action="{{ route('leave.store') }}" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                        @csrf
                        <div class="row leave-row border" style="margin-top: 20px">
                            <div class="col-md-12 mt-6 " style="padding-top: 20px">
                                <div class="form-group">
                                    <label for="leave_type" class="control-label"><b>Select Type</b><small class="text-danger required">*</small></label>
                                    <input type="radio" class="radio" style="margin-right: 5px" required name="leave_type" value="1" onclick="leaveType(this.value)" @if(old('leave_type')==1) checked @endif><b>Leave</b>
                                    <input type="radio" class="radio" style="margin-right: 5px" required name="leave_type" value="4" onclick="leaveType(this.value)" @if(old('leave_type')==4) checked @endif><b>Half Day</b>
                                    <input type="radio" class="radio" style="margin-right: 5px" required name="leave_type" value="2" onclick="leaveType(this.value)" @if(old('leave_type')==2) checked @endif><b>Permission</b>
                                    <input type="radio" class="radio" style="margin-right: 5px" required name="leave_type" value="3" onclick="leaveType(this.value)" @if(old('leave_type')==3) checked @endif><b>WFH</b>
                                    @error('leave_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12" id="leave_details" style="display: none;">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="leave_start_date" class="control-label">Leave Required From<small class="text-danger required">*</small></label>
                                            <p><input name="leave_start_date" type="date" id="leave_start_date" class="form-control" value="{{ old('leave_start_date') }}"></p>
                                            @error('leave_start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="leave_end_date" class="control-label">Leave Required To<small class="text-danger required">*</small></label>
                                            <p><input name="leave_end_date" type="date" id="leave_end_date" class="form-control" onchange="cal()" value="{{ old('leave_end_date') }}"></p>
                                            @error('leave_end_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reporting_to" class="control-label">Reporting To<small class="text-danger required">*</small></label>
                                            <input disabled="" type="text" class="form-control" value="{{ reportingName(auth()->user()->reporting_to) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="user" class="control-label">Reporting Email<small class="text-danger required">*</small></label>
                                            <input disabled="" type="text" class="form-control" value="{{ reportingEmail(auth()->user()->reporting_to) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reason" class="control-label">Reason For The Leave<small class="text-danger required">*</small></label>
                                            <textarea name="leave_reason" class="form-control" id="leave_reason">{{ old('leave_reason') }}</textarea>
                                            @error('leave_reason')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 no-label text-right">
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="half_day_leave" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="date" class="control-label">Date<small class="text-danger required">*</small></label>
                                            <p><input name="half_leave_date" type="date" id="half_leave_date" class="form-control" value="{{ old('half_leave_date') }}"></p>
                                            @error('half_leave_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><br>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reporting_to" class="control-label">Reporting To<small class="text-danger required">*</small></label>
                                            <input disabled="" type="text" class="form-control" value="{{ reportingName(auth()->user()->reporting_to) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="user" class="control-label">Reporting Email<small class="text-danger required">*</small></label>
                                            <input disabled="" type="text" class="form-control" value="{{ reportingEmail(auth()->user()->reporting_to) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reason" class="control-label">Reason<small class="text-danger required">*</small></label>
                                            <textarea name="half_leave_reason" class="form-control" id="half_leave_reason">{{ old('half_leave_reason') }}</textarea>
                                            @error('half_leave_reason')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 no-label text-right">
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="permission_details" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="start_time" class="control-label">Permission Required From<small class="text-danger required">*</small></label>
                                            <input name="start_time" type="datetime-local" id="start_time" class="form-control" value="{{ old('start_time') }}" min="{{ date('Y-m-d') }}T00:00">
                                            @error('start_time')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="end_time" class="control-label">Permission Required To<small class="text-danger required">*</small></label>
                                            <input name="end_time" type="datetime-local" id="end_time" class="form-control" value="{{ old('end_time') }}" min="{{ date('Y-m-d') }}T00:00">
                                            @error('end_time')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reporting_to" class="control-label">Reporting To<small class="text-danger required">*</small></label>
                                            <input disabled="" type="text" class="form-control" value="{{ reportingName(auth()->user()->reporting_to) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="user" class="control-label">Reporting Email<small class="text-danger required">*</small></label>
                                            <input disabled="" type="text" class="form-control" value="{{ reportingEmail(auth()->user()->reporting_to) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reason" class="control-label">Reason<small class="text-danger required">*</small></label>
                                            <textarea name="reason" class="form-control" id="reason">{{ old('reason') }}</textarea>
                                            @error('reason')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 no-label text-right">
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="work_details" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="leave_start_date" class="control-label">WFH Required From<small class="text-danger required">*</small></label>
                                            <input name="start_date" type="date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                                            @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="end_date" class="control-label">WFH Required To<small class="text-danger required">*</small></label>
                                            <input name="end_date" type="date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                                            @error('end_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reporting_to" class="control-label">Reporting To<small class="text-danger required">*</small></label>
                                            <input disabled="" type="text" class="form-control" value="{{ reportingName(auth()->user()->reporting_to) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="user" class="control-label">Reporting Email<small class="text-danger required">*</small></label>
                                            <input disabled="" type="text" class="form-control" value="{{ reportingEmail(auth()->user()->reporting_to) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="work_reason" class="control-label">Reason<small class="text-danger required">*</small></label>
                                            <textarea name="work_reason" class="form-control" id="work_reason">{{ old('work_reason') }}</textarea>
                                            @error('work_reason')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="task_type" class="control-label">Priority<small class="text-danger required">*</small></label><br>
                                            <input type="radio" class="radio" required name="task_type" value="1" checked onclick="taskType(this.value)" @if(old('task_type')==1) checked @endif> Business Critical
                                            <input type="radio" class="radio" required name="task_type" value="2" onclick="taskType(this.value)" @if(old('task_type')==2) checked @endif> Time Critical
                                            <input type="radio" class="radio" required name="task_type" value="3" onclick="taskType(this.value)" @if(old('task_type')==3) checked @endif> Both
                                            @error('task_type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="task_type">
                                        <div class="form-group">
                                            <label for="reason" id="business_critical" class="control-label">Why Business Critical<small class="text-danger required">*</small></label>
                                            <label for="reason" id="time_critical" class="control-label" style="display: none;">Why Time Critical<small class="text-danger required">*</small></label>
                                            <label for="reason" id="time_business_critical" class="control-label" style="display: none;">Why Business Critical & Time Critical<small class="text-danger required">*</small></label>
                                            <textarea name="task_reason" class="form-control" id="task_reason">{{ old('task_reason') }}</textarea>
                                            @error('task_reason')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="reason" class="control-label">Work Plan<small class="text-danger required">*</small></label>
                                            <textarea name="task_plan" class="form-control" id="task_plan">{{ old('task_plan') }}</textarea>
                                            @error('task_plan')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 no-label text-right">
                                    <div class="form-group">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Content End-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    /*Married Status*/
    function leaveType(a) {
        if (a == 1) {
            $('#leave_details').show();
            $('#permission_details').hide();
            $('#work_details').hide();
            $('#half_day_leave').hide();
        } else if (a == 2) {
            $('#permission_details').show();
            $('#leave_details').hide();
            $('#work_details').hide();
            $('#half_day_leave').hide();
        } else if (a == 3) {
            $('#work_details').show();
            $('#leave_details').hide();
            $('#permission_details').hide();
            $('#half_day_leave').hide();
        } else if (a == 4) {
            $('#half_day_leave').show();
            $('#leave_details').hide();
            $('#permission_details').hide();
            $('#work_details').hide();
        }
    }
    leaveType('<?php echo old('leave_type'); ?>');

    /*Task Type*/
    function taskType(a) {
        if (a == 1) {
            $('#business_critical').show();
            $('#time_critical').hide();
            $('#time_business_critical').hide();
        } else if (a == 2) {
            $('#business_critical').hide();
            $('#time_critical').show();
            $('#time_business_critical').hide();
        } else if (a == 3) {
            $('#business_critical').hide();
            $('#time_critical').hide();
            $('#time_business_critical').show();
        }
    }


    function toggle() {
        $('#leaveType').show();
    }

    // function GetDays() {
    //     var dropdt = new Date(document.getElementById("leave_start_date").value);
    //     var pickdt = new Date(document.getElementById("leave_end_date").value);
    //     return parseInt((pickdt - dropdt) / (24 * 3600 * 1000) + 1);
    // }

    // function cal() {
    //     if (document.getElementById("leave_start_date")) {
    //         document.getElementById("numdays2").value = GetDays();
    //     }
    // }
    // $(document).ready(function() {
    //     $(document).on('change', '.leave_type', function() {
    //         var leave_id = $(this).val();
    //         $('.leave_detail').val(leave_id);
    //     });
    // });
</script>
@endsection