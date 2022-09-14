@extends('larasnap::layouts.app', ['class' => 'helpdesk-edit'])
@section('title','Help Desk')
@section('content')
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Edit Ticket</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <a href="{{ route('helpdesks.index') }}" title="Back to Admin List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Ticket List
               </a>
               <br> <br>
               <form method="POST" action="{{ route('helpdesks.update', $helpdesk->id) }}"  enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
			   @csrf
			   @method('PUT')
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="category" class="control-label">Category</label>
                              <select name="category" class="form-control" id="category">
                                  @foreach($categories->childCategory as $category)
                                      <option value="{{$category->id}}" {{old('category',$category->id==$helpdesk->category_id ? 'selected':"")}}>{{$category->label}}</option>
                                  @endforeach
                              </select>
                              @error('category')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="subject" class="control-label">Subject<small class="text-danger required">*</small></label>
							<input name="subject" type="text" id="subject" class="form-control" value="{{ old('subject', $helpdesk->subject) }}">
							@error('subject')
							 <span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>

                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="description" class="control-label">Description</label>
                              <textarea  name="description" class="form-control" id="description">{{ old('description', $helpdesk->description)}}</textarea>
                              @error('description')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>


                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="images" class="control-label">Images</label>
                              <input type="file" name="images" class="form-control" id="images" value="{{ old('images', $helpdesk->images)}}">
                              @error('images')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
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

