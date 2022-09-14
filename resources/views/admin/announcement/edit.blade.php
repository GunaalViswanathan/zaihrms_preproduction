@extends('larasnap::layouts.app', ['class' => 'announcement-edit'])
@section('title','Announcements')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Edit Announcement</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('announcement.index') }}" title="Back to Admin List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Announcement List
               </a>
               <br> <br>
               <form method="POST" action="{{ route('announcement.update', $announcement->id) }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
			   @csrf
			   @method('PUT')
                  <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="title" class="control-label">Title<small class="text-danger required">*</small></label>
							<input name="title" type="text" id="title" class="form-control" value="{{ old('title', $announcement->title ? $announcement->title : '-NA-') }}">
							@error('title')
							 <span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label for="description" class="control-label">Description</label>
							<textarea name="description" class="form-control" id="description">{{ old('description', $announcement->description ? $announcement->description: '-NA-') }}</textarea>
						</div>
					</div>

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

