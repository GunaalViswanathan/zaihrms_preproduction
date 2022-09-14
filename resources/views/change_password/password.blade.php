@extends('larasnap::layouts.app', ['class' => 'user-change_password'])
@section('title','User Management')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
</div>

<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update_password', auth()->user()->id) }}" enctype="multipart/form-data" id="my_form" class="form-horizontal" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class='change_password'>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="old_password" class="control-label">Old Password<small class="text-danger required">*</small></label>
                                        <input name="old_password" type="password" id="old_password" class="form-control" />
                                        @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="control-label">New Password<small class="text-danger required">*</small></label>
                                        <input name="password" type="password" id="password" class="form-control"  />
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password" class="control-label">Confirm Password<small class="text-danger required">*</small></label>
                                        <input name="confirm_password" type="password" id="confirm_password" class="form-control" />
                                        @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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