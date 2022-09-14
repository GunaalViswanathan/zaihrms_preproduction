@extends('larasnap::layouts.app', ['class' => 'user-create'])
@section('title','Project Management')
@section('content')
<style>
.error {
    color: #f70909;
    font-size: 15px;
    position: relative;
    line-height: 1;
    width: 100%;
}
</style>
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Project</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <a href="{{ route('project.index') }}" title="Back to Project List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Project List</a>
                    <br> <br>
                    <form method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data" class="form-horizontal" id="my_form" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="project_name" class="control-label">Project Name<small class="text-danger required">*</small></label>
                                    <input name="project_name" type="text" id="project_name" class="form-control" value="{{ old('project_name') }}">
                                    @error('project_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date" class="control-label">Start Date<small class="text-danger required">*</small></label>
                                    <input name="start_date" type="date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                                    @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date" class="control-label">End Date<small class="text-danger required">*</small></label>
                                    <input name="end_date" type="date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                                    @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="allocated_hours" class="control-label">Allocated Hours<small class="text-danger required">*</small></label>
                                    <input name="allocated_hours" type="text" id="allocated_hours" class="form-control" value="{{ old('allocated_hours') }}">
                                    @error('allocated_hours')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client_name" class="control-label">Client Name<small class="text-danger required">*</small></label>
                                    <input name="client_name" type="text" id="client_name" class="form-control" value="{{ old('client_name') }}">
                                    @error('client_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="client_company" class="control-label">Client Company<small class="text-danger required">*</small></label>
                                    <input name="client_company" type="text" id="client_company" class="form-control" value="{{ old('client_company') }}">
                                    @error('client_company')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mail" class="control-label">Client Mail Address<small class="text-danger required">*</small></label>
                                    <input name="mail" type="mail" id="mail" class="form-control" min="0" value="{{ old('mail') }}">
                                    @error('mail')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="project_type" class="control-label">Project Type<small class="text-danger required">*</small></label>
                                    @if(config('larasnap.module_list.user.project-type'))
                                    <select name="project_type" class="form-control" id="project_type" onchange="filterByID(this.value)">
                                        <option value="">Select Project Type</option>
                                        @foreach (config('larasnap.module_list.user.project-type') as $type => $option)
                                        <option @if(old('project_type')==$type) selected @endif value="{{ $type }}">{{ $option['label'] }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    @error('project_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 profile-status">
                                <div class="form-group">
                                    <label for="project_status" class="control-label">Project Status<small class="text-danger required">*</small></label>
                                    @if(config('larasnap.module_list.user.project-status'))
                                    <select name="project_status" class="form-control" id="project_status" onchange="filterByID(this.value)">
                                        <option value="">Select Status</option>
                                        @foreach (config('larasnap.module_list.user.project-status') as $index => $option)
                                        <option @if(old('project_status')==$index) selected @endif value="{{$index}}">{{ $option['label'] }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    @error('project_status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="status">Select Resource<small class="text-danger">*</small></label><br>
                            </div>
                            @foreach ($resource as $option=>$value) 
                            <div class="col-md-12">
                            <b>{{$value->fullname}}</b> <br>
                            </div>
                            @foreach($value->employee as $key=>$getEmployee)                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="checkbox" id="resource" name="resource[]" value="{{ $getEmployee->id }}" @if(in_array($value->employee, old('resource') ? old('resource') : [])) checked @endif > {{$getEmployee->full_name}}
                                </div>
                            </div>                            
                            @endforeach
                            @endforeach<br>
                            
                            @error('resource')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </select>
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
