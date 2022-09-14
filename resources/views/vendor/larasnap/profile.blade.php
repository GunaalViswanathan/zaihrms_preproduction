@extends('larasnap::layouts.app', ['class' => 'profile'])
@section('title','Update Profile')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Update Profile</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <div class="text-left mb-3">
                        <a href="{{ route('profile.edit') }}" title="Back to Profile" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Profile
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-12 title">
                            <p class="p-title">Personal Details</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('profile.update', $user->id) }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name" class="control-label">First Name<small class="text-danger required">*</small></label>
                                    <input name="first_name" type="text" id="first-name" class="form-control" value="{{ old('first_name', $user->userProfile ? $user->userProfile->first_name : '') }}">
                                    @error('first_name')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last-name" class="control-label">Last Name<small class="text-danger required">*</small></label>
                                    <input name="last_name" type="text" id="last-name" class="form-control" value="{{ old('last_name', $user->userProfile ? $user->userProfile->last_name : '') }}">
                                    @error('last_name')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="control-label">Official Email Address<small class="text-danger required">*</small></label>
                                    <input name="email" type="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email" class="control-label">Personal Email Address<small class="text-danger required">*</small></label>
                                    <input name="personal_email" type="email" id="personal_email" class="form-control" value="{{ old('personal_email', $user->userProfile ? $user->userProfile->personal_email : '') }}">
                                    @error('personal_email')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile-no" class="control-label">Mobile Number<small class="text-danger required">*</small></label>
                                    <input name="mobile_no" type="number" id="mobile-no" class="form-control" min="0" value="{{ old('mobile_no', $user->userProfile ? $user->userProfile->mobile_no : '') }}">
                                    @error('mobile_no')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="alter_mobile" class="control-label">Alternate/Emergency Mobile<small class="text-danger required">*</small></label>
                                    <input name="alternate_mobile_number" type="text" id="alternate_mobile_number" class="form-control" value="{{ old('alternate_mobile_number', $user->userProfile ? $user->userProfile->alternate_mobile_number : '') }}">
                                    @error('alternate_mobile_number')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dob" class="control-label">Date of Birth<small class="text-danger required">*</small></label>
                                    <input name="dob" type="date" id="dob" class="form-control" value="{{ old('dob', $user->userProfile ? $user->userProfile->dob : '') }}">
                                    @error('dob')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="residential_address" class="control-label">Residential Address<small class="text-danger required">*</small></label>
                                    <textarea name="residential_address" class="form-control" id="residential_address">{{ old('residential_address', $user->userProfile ? $user->userProfile->residential_address : '') }}</textarea>
                                    @error('residential_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="permanent_address" class="control-label"></label>
                                    <input type="checkbox" class="checkbox" id="same_address" name="same_address" value="1" onclick="fillAddress(this);"> Same as Residential Address
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="permanent_address" class="control-label">Permanent Address<small class="text-danger required">*</small></label>
                                    <textarea name="permanent_address" class="form-control" id="permanent_address">{{ old('permanent_address', $user->userProfile ? $user->userProfile->permanent_address : '') }}</textarea>
                                    @error('permanent_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="blood_group" class="control-label">Blood Group<small class="text-danger required">*</small></label>
                                      <input name="blood_group" type="text" id="blood_group" class="form-control" value="{{ old('blood_group', $user->userProfile ? $user->userProfile->blood_group : '') }}">
                                      @error('blood_group')
                                      <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="aadhar_number" class="control-label">Aadhaar Number<small class="text-danger required">*</small></label>
                                    <input name="aadhar_number" type="text" id="aadhar_number" class="form-control" value="{{ old('aadhar_number', $user->userProfile ? $user->userProfile->aadhar_number : '') }}">
                                    @error('aadhar_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_number" class="control-label">Pan Number<small class="text-danger required">*</small></label>
                                    <input name="pan_number" type="text" id="pan_number" class="form-control" value="{{ old('pan_number', $user->userProfile ? $user->userProfile->pan_number : '') }}">
                                    @error('pan_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name" class="control-label">Bank Name<small class="text-danger required">*</small></label>
                                    <input name="bank_name" type="text" id="bank_name" class="form-control" value="{{ old('bank_name', $user->userProfile ? $user->userProfile->bank_name : '') }}">
                                    @error('bank_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_number" class="control-label">Account Number<small class="text-danger required">*</small></label>
                                    <input name="account_number" type="text" id="account_number" class="form-control" value="{{ old('account_number', $user->userProfile ? $user->userProfile->account_number : '') }}">
                                    @error('account_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code" class="control-label">IFSC Code<small class="text-danger required">*</small></label>
                                    <input name="ifsc_code" type="text" id="ifsc_code" class="form-control" value="{{ old('ifsc_code', $user->userProfile ? $user->userProfile->ifsc_code : '') }}">
                                    @error('ifsc_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="holder_name" class="control-label">Account Holder Name<small class="text-danger required">*</small></label>
                                    <input name="account_holder_name" type="text" id="account_holder_name" class="form-control" value="{{ old('account_holder_name', $user->userProfile ? $user->userProfile->holder_name : '') }}">
                                    @error('account_holder_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_joining" class="control-label">Date of Joining<small class="text-danger required">*</small></label>
                                    <input name="date_of_joining" type="date" id="date_of_joining" class="form-control" value="{{ old('date_of_joining', $user->userProfile ? $user->userProfile->date_of_joining : '') }}">
                                    @error('date_of_joining')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reporting" class="control-label">Reporting</label>
                                    <input type="text" class="form-control" readonly value="{{ reportingName($user->reporting_to) }}">
                                    <input type="hidden" class="form-control" name="reporting_to" value="{{ $user->reporting_to }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="user_photo" class="control-label">Profile Picture</label>
                                    <input name="user_photo" type="file" id="user-photo" class="form-control" >
                                     @error('user_photo')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <small>Allowed File Formats: jpg, jpeg, png</small>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="user_photo" class="control-label"></label>
                                    <p><img src="{{ $user->avatar }}" style="width: 50px;" alt="Prof Picture" ></p>
                                </div>
                            </div>
                            <div class="col-md-12 title mt-3">
                                <p class="p-title">Family Details</p>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label for="father_name" class="control-label">Father Name<small class="text-danger required">*</small></label>
                                    <input name="father_name" type="text" id="first-name" class="form-control" value="{{ old('father_name', $user->userFamily ? $user->userFamily->father_name : '') }}">
                                    @error('father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label for="mother-name" class="control-label">Mother Name<small class="text-danger required">*</small></label>
                                    <input name="mother_name" type="text" id="mother_name" class="form-control" value="{{ old('mother_name', $user->userFamily ? $user->userFamily->mother_name : '') }}">
                                    @error('mother_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label for="marital-status" class="control-label">Marital Status<small class="text-danger required">*</small></label><br>
                                    <input type="radio" class="radio" name="marital_status" value="1" onclick="maritalStatus(this.value)" @if(old('marital_status', $user->userFamily ? $user->userFamily->marital_status : '') == 1) checked @endif> Married
                                    <input type="radio" class="radio" name="marital_status" value="0" onclick="maritalStatus(this.value)" @if(old('marital_status', $user->userFamily ? $user->userFamily->marital_status : '') == 0) checked @endif> Single
                                    @error('marital_status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12" id="mar_details" style="display: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date_of_married" class="control-label">Date of Married<small class="text-danger required">*</small></label>
                                            <input name="date_of_married" type="date" id="date_of_married" class="form-control" value="{{ old('date_of_married', $user->userFamily ? $user->userFamily->date_of_married : '') }}">
                                            @error('date_of_married')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="spouse_name" class="control-label">Spouse Name<small class="text-danger required">*</small></label>
                                            <input name="spouse_name" type="text" id="spouse_name" class="form-control" value="{{ old('spouse_name', $user->userFamily ? $user->userFamily->spouse_name : '') }}">
                                            @error('spouse_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mother-name" class="control-label">No of Children<small class="text-danger required">*</small></label>
                                            <input name="no_of_children" type="text" id="no_of_children" class="form-control" value="{{ old('no_of_children', $user->userFamily ? $user->userFamily->no_of_children : '') }}">
                                            @error('no_of_children')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 no-label text-right">
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
				        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 title">
                            <p class="p-title">Educational Details</p>
                            <a href="javascript:show_education_details_popup('{{ $user->id }}','{{url('/education_detail')}}','add');" style="color: white; float: right; margin-top: -34px;" title="Add Education"><button type="button" class="btn btn-info btn-fill pull" style="margin-bottom: 5px;  background-color: darkgrey!important; border-color: darkgrey !important;"><i class="fa fa-plus" style=" color: #fff;"></i></button></a
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="educationajaxupload"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 title">
                            <p class="p-title">Experience Details</p>
                            <a href="javascript:show_experience_details_popup('{{ $user->id }}','{{url('/experience_detail')}}','add');" style="color: white; float: right; margin-top: -34px;" title="Add Education"><button type="button" class="btn btn-info btn-fill pull" style="margin-bottom: 5px;  background-color: darkgrey!important; border-color: darkgrey !important;"><i class="fa fa-plus" style=" color: #fff;"></i></button></a
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="experienceajaxupload"></div>
                </div>
            </div>
        </div>
    </div>
<!-- User Experience Pop-Up End -->
@include('admin.employee.education')
@include('admin.employee.experience')
<!-- User Experience Pop-Up End -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    function fillAddress(){
        if ($('#same_address').is(':checked')) {
            $("#permanent_address").val($("#residential_address").val());
            $("#permanent_address").attr('readonly', 'readonly');
        } else {
            $("#permanent_address").val('');
            $("#permanent_address").removeAttr('readonly');
        }
    }
    function address(a) {
        if (a == 1) {
            $('#same_address').prop('checked',true)
            $("#permanent_address").val($("#residential_address").val());
            $("#permanent_address").attr('readonly', 'readonly');
        } else {
            $('#same_address').prop('checked',false)
            $("#permanent_address").removeAttr('readonly');
        }
    }
    address('<?php echo old('same_address', $user->userProfile ? $user->userProfile->same_address : ''); ?>');
   /*Married Status*/
    function maritalStatus(a) {
        if (a == 1) {
            $('#mar_details').show();
        } else {
            $('#mar_details').hide();
            $('#date_of_married').val('');
            $('#spouse_name').val('');
            $('#no_of_children').val('');
        }
    }
    maritalStatus('<?php echo old('marital_status', $user->userFamily ? $user->userFamily->marital_status : ''); ?>');
</script>
<!-- Page Content End-->
@endsection
