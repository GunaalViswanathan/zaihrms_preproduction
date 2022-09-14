@extends('larasnap::layouts.app', ['class' => 'holiday-create'])
@section('title','Holiday List')
@section('content')

<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Add Holiday</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('holidays.index') }}" title="Back to Holiday List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Holiday List
               </a>
               <br> <br>
               <form method="POST" action="{{ route('holidays.store') }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
			   @csrf
                  <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="holiday_name" class="control-label">Holiday Name<small class="text-danger required">*</small></label>
							<input name="holiday_name" type="text" id="holiday_name" class="form-control" value="{{ old('holiday_name') }}" >
							@error('holiday_name')
							 <span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="holiday_date" class="control-label">Holiday Date<small class="text-danger required">*</small></label>
							<input type="date" name="holiday_date" class="form-control" id="holiday_date">
                            @error('holiday_date')
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


