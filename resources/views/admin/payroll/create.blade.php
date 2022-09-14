@extends('larasnap::layouts.app', ['class' => 'holiday-create'])
@section('title','Payslip')
@section('content')

<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Payslip({{$employee->email}})</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('payrolls.index') }}" title="Back to Holiday List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Search
               </a>
               <br> <br>
               <form method="POST" action="{{ route('payrolls.generate') }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
			   @csrf
                   <input type="hidden" name="employee_id" value="{{larasnapEncrypt($employee->id)}}">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="month" class="control-label">Select Month<small class="text-danger required">*</small></label>
                              <select name="month" class="form-control">
                                  <option value="" selected>Select Month</option>
                                  @for($m=1; $m<=12; $m++)
                                      <option value="{{$month = date('F', mktime(0,0,0,$m, 1, date('Y')))}}" {{old('month')==date('F', mktime(0,0,0,$m, 1, date('Y'))) ? 'selected':""}}>{{$month = date('F', mktime(0,0,0,$m, 1, date('Y')))}}</option>
                                  @endfor
                              </select>
                              @error('month')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="payslip" class="control-label">Upload Payslip<small class="text-danger required">*</small></label>
                              <input type="file" name="payslip" class="form-control">
                          </div>
                          @error('payslip')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="payslip" class="control-label">Year<small class="text-danger required">*</small></label>
                      <select name="year" class="form-control">
                          <option value="" selected>Select Year</option>
                          <option
                              value="{{\Carbon\Carbon::now()->format('Y')}}" {{old('year')==\Carbon\Carbon::now()->format('Y') ? 'selected':""}}>{{\Carbon\Carbon::now()->format('Y')}}</option>
                          <option
                              value="{{date('Y', strtotime('last year'))}}" {{old('year')==date('Y', strtotime('last year')) ? 'selected':""}}>{{date('Y', strtotime('last year'))}}</option>
                      </select>
                          </div>
                          @error('year')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>

					<div class="col-md-4 no-label">
						<div class="form-group">
							<input type="submit" value="Submit" class="btn btn-primary">
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


