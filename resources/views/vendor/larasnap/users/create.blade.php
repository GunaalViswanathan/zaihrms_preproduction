@extends('larasnap::layouts.app', ['class' => 'user-create'])
@section('title','Admin Management')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Add Admin</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('users.index') }}" title="Back to Admin List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Admin List
               </a>
               <br> <br>
               <form method="POST" action="{{ route('users.store') }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
			   @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name" class="control-label">First Name<small class="text-danger required">*</small></label>
                                <input name="first_name" type="text" id="first-name" class="form-control" value="{{ old('first_name') }}" >
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name" class="control-label">Last Name<small class="text-danger required">*</small></label>
                                <input name="last_name" type="text" id="last-name" class="form-control" value="{{ old('last_name') }}" >
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
                                <input name="mobile_number" type="text" id="mobile-no" class="form-control" min="0" value="{{ old('mobile_number') }}">
                                @error('mobile_number')
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="user_photo" class="control-label">Profile Picture</label>
                                <input name="user_photo" type="file" id="user-photo" class="form-control" >
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
                                <input type="radio" name="status" value="0" id="inactive" {{ old('status')=="0" ? 'checked' : '' }} >
                                <label for="inactive">InActive</label>
                            </div>
                        </div>
                        <div class="col-md-4 no-label">
                            <div class="form-group">
                                <input type="submit" value="Save" class="btn btn-primary">
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
@endsection
