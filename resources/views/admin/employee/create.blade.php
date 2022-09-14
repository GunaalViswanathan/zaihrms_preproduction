@extends('larasnap::layouts.app', ['class' => 'user-create'])
@section('title','Employee Management')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Employee</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <a href="{{ route('employee.index') }}" title="Back to User List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Employee List</a>
                    <br> <br>
                    <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name" class="control-label">First Name<small class="text-danger required">*</small></label>
                                    <input name="first_name" type="text" id="first-name" class="form-control" value="{{ old('first_name') }}">
                                    @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name" class="control-label">Last Name<small class="text-danger required">*</small></label>
                                    <input name="last_name" type="text" id="last-name" class="form-control" value="{{ old('last_name') }}">
                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email Address<small class="text-danger required">*</small></label>
                                    <input name="email" type="email" id="email" class="form-control" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile-no" class="control-label">Mobile Number<small class="text-danger required">*</small></label>
                                    <input name="mobile_number" type="number" id="mobile-no" class="form-control" min="0" value="{{ old('mobile_number') }}">
                                    @error('mobile_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="team" class="control-label">Team<small class="text-danger required">*</small></label>
                                    <select name="team" id="team" class="form-control ml-10" onchange="dropdownChange()">
                                        <option value="" selected>Select Team</option>
                                        @foreach($categories->childCategory as $category)
                                        <option value="{{$category->id}}" {{old('team')== $category->id ? 'selected':""}}> {{$category->label}}</option>
                                        @endforeach

                                    </select>
                                    @error('team')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password" class="control-label">Password<small class="text-danger required">*</small></label>
                                    <input name="password" type="password" id="password" class="form-control" value="{{ old('password') }}">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password-confirmation" class="control-label">Confirm Password<small class="text-danger required">*</small></label>
                                    <input name="password_confirmation" type="password" id="password-confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4 profile-status">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-address2" id="primary_reporter">Primary Reporter</label><br>
                                    <input onclick="checkRadioValue()" type="radio" name="primary_reporter" value="1" id="active" {{ old('primary_reporter')=="1" ? 'checked' : '' }} disabled />
                                    <label for="yes">Yes</label>

                                    <input onclick="checkRadioValue()" type="radio" name="primary_reporter" value="0" id="inactive" {{ old('primary_reporter')=="0" ? 'checked' : '' }} disabled />
                                    <label for="no">No</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_photo" class="control-label">Profile Picture</label>
                                    <input name="user_photo" type="file" id="user-photo" value="{{ old('user_photo') }}" class="form-control">
                                    @error('user_photo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small>Allowed File Formats: jpg, jpeg, png</small>
                            </div>
                            <div class="col-md-4 profile-status">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-address2">Status</label><br>
                                    <input type="radio" name="status" value="1" id="active" checked="">
                                    <label for="active">Active</label>
                                    <input type="radio" name="status" value="0" id="inactive" {{ old('status')=="0" ? 'checked' : '' }}>
                                    <label for="inactive">InActive</label>
                                </div>
                            </div>
                            <!-- jfurfr -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div id="mycode" style="display:none">
                                        <h3 id="team_name"></h3>

                                        <br>

                                        <div class="col-md-12" id="juniorsHtml">

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="reporting" class="control-label">Reporting To<small class="text-danger required">*</small></label>
                                                <select name="reporting_to" id="reporting_to" class="form-control ml-10">
                                                    <option selected value="">Select Reporting</option>
                                                    @forelse($users as $index => $cate)
                                                    <option value="{{ $cate->id }}" {!! old('reporting_to')==$cate->id ? 'selected' : '' !!} >
                                                        {{ ucwords($cate->userProfile->first_name.' '.$cate->userProfile->last_name) }}
                                                    </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @error('reporting_to')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 no-label">
                                <div class="form-group">
                                    <input type="submit" value="Save" class="btn btn-primary">
                                </div>
                            </div>
                        </div>

                        <div id="code" style="display:none">
                            <div class="col-md-4">
                                <div class="form-group" id="reportingDiv" name="reporting_to">

                                    @error('reporting_to')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endsection
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    // var value = $("input[type=radio][name=primary_reporter]:checked").val();
    function dropdownChange() {
        const value = $('#team').val();
        if (value == "") {
            $("input[name=primary_reporter]").attr("disabled", true);
        } else {
            $("input[name=primary_reporter]").attr("disabled", false);
            checkRadioValue();
        }
    }

    function checkRadioValue() {
        var value = document.getElementsByName("primary_reporter");
        var selected = Array.from(value).find(radio => radio.checked);

        let myCode = document.getElementById("mycode");
        let code = document.getElementById("code");

        if (selected.value == 1) {
            myCode.style.display = "block";
            code.style.display = "none";
            //----------displaying the Selected team -------------------------//
            var teamName = $('#team :selected').text();
            $("#team_name").text(teamName);
            Juniors();
        } else {
            Reporter();
            code.style.display = "block";
            myCode.style.display = "none";
        }
        // selected.value == 1 ? myCode.style.display = "block" : selected.value == 1 ? code.style.display = "none" :
        // selected.value == 0 ? code.style.display = "block" : selected.value == 0 ?  myCode.style.display = "none": "";
    }

    function Juniors() {
        var teamName = $("#team").val();
        var BaseURL = "<?php echo url('/');  ?>";
        var URL = BaseURL + '/employee/get_juniors';
        // alert(URL);
        $.ajax({
            url: URL,
            type: "GET",
            data: {
                'team_id': teamName,
            },
            success: function(response) {
                var html = "";
                $.each(response.juniors, function(key, value) {
                    console.log('junir', value);
                    html += `<div><input class="form-group" type="checkbox" name="employeecheckbox[]" value="${value.user_id}" id="flexCheckDefault">`;
                    html += `<label name="checkbox" for="flexCheckDefault">${value.user_id} ${value.first_name +' '+value.last_name}</label></div>`;
                });
                $('#juniorsHtml').html(html);
            },
        });

    }
</script>

<script>
    function Reporter() {
        var teamName = $("#team").val();
        var BaseURL = "<?php echo url('/');  ?>";
        var URL = BaseURL + '/reporter/get_reporter';
        // alert(teamName);

        $.ajax({
            url: URL,
            type: "GET",
            data: {
                'team_id': teamName,
            },
            success: function(response) {
                var html = "";
                html += `<div class="form-group"><label for="reporting_to" class="control-label">Reporting To<small class="text-danger required">*</small></label>`

                html += `<select name="reporting_to" id="reporting_to" class="form-control ml-10">`
                html += `<option selected value="">Select Reporting</option>`

                $.each(response.reporter, function(key, value) {
                    html += `<option value="${value.user_id}" >${value.first_name +' '+value.last_name}</option>`

                });
                html += `</select>`;
                $('#reportingDiv').html(html);
            },
        });
    }
</script>

<!-- Page Content End-->