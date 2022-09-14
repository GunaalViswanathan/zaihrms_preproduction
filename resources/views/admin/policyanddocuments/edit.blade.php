@extends('larasnap::layouts.app', ['class' => 'policyanddocuments-edit'])
@section('title','Policies')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Edit Policy</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('policyanddocuments.index') }}" title="Back to Policy List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Policy List
               </a>
               <br> <br>
               <form method="POST" action="{{ route('policyanddocuments.update', $policyanddocuments->id) }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                   @csrf
			   @method('PUT')
                  <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="policy_name" class="control-label">Policy Name<small class="text-danger required">*</small></label>
							<input name="policy_name" type="text" id="policy_name" class="form-control" value="{{ old('policy_name', $policyanddocuments->title ? $policyanddocuments->title : '-NA-') }}">
							@error('policy_name')
							 <span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="description" class="control-label">Description</label>
							<textarea name="description" class="form-control" id="description">{{ old('description', $policyanddocuments->description ? $policyanddocuments->description: '-NA-') }}</textarea>
						</div>
					</div>
                      <div class="col-md-12">
                          <div class="">
                              <label for="document" class="control-label">Document<small class="text-danger required">*</small></label>
                              <input name="document" type="file" id="document" class="form-control" >
                              @error('document')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>

                          <small>Allowed File Formats: pdf</small>
                        @if($policyanddocuments->document)
                          <p>Click here to view uploaded document <a  href="{{url('storage/app/public/upload/policyanddocument/').'/'.$policyanddocuments->document}}" style="width: 50px;" alt="Prof Picture" target="_blank" >{{$policyanddocuments->document}}</a></p>
                      </div>

                          @endif


					<div class="col-md-4 no-label">
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
<!-- Page Content End-->
@endsection

