@extends('larasnap::layouts.app', ['class' => 'settings-create'])
@section('title','Site Settings')
@section('content')
<style>
   .bootstrap-tagsinput .tag {
    padding-top: 6px !important;
    display: inline-block !important;
    padding: 0.3em 0.5em !important;
    padding-right: 1.5em !important;
    border-radius: 3px !important;
    color: black !important;
    background: #E5E5E5 !important;
    transition: .13s ease-out !important;
    line-height: 17px !important;
    
}
.bootstrap-tagsinput{
   width:100%  !important;
   
   line-height: 27px !important;
}
</style>
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Settings</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
   <div class="col-xl-12">
      <div class="card shadow mb-4">
         <div class="card-body">
            <div class="card-body">
               <form method="POST" action="{{ route('settings.store') }}" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" id="myForm">
                  @csrf
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="name" class="control-label">Site Name<small class="text-danger required">*</small></label>
                           <input name="site_name" type="text" id="site-name" class="form-control" value="{{ old('name', $setting_db_values['site_name']) }}">
                           @error('site_name')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="">
                           <label for="logo" class="control-label">Site Logo</label>
                           <input name="site_logo" type="file" id="site-logo" class="form-control">
                           <small>Allowed File Formats: jpg, jpeg, png</small>
                           @error('site_logo')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="admin-email" class="control-label">Admin Email<small class="text-danger required">*</small></label>
                           <input name="admin_email" type="email" id="admin-email" class="form-control" value="{{ old('admin_email', $setting_db_values['admin_email']) }}">
                           @error('admin_email')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="date-format" class="control-label">Date Format<small class="text-danger required">*</small></label>
                           <select class="form-control ts" name="date_format" id="date-format">
                              <option value="" selected="selected" disabled="disabled">Select Date Format</option>
                              @foreach(config('larasnap.settings.date_format') as $key => $value)
                              <option value="{{ $value }}" @if(old('date_format', $setting_db_values['date_format'])==$value ) selected @endif>{{ date($value)}}</option>
                              @endforeach
                           </select>
                           @error('date_format')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="date-time-format" class="control-label">Date Time Format<small class="text-danger required">*</small></label>
                           <select class="form-control ts" name="date_time_format" id="date-time-format">
                              <option value="" selected="selected" disabled="disabled">Select Date Time Format</option>
                              @foreach(config('larasnap.settings.date_time_format') as $key => $value)
                              <option value="{{ $value }}" @if(old('date_time_format',$setting_db_values['date_time_format'])==$value ) selected @endif>{{ date($value)}}</option>
                              @endforeach
                           </select>
                           @error('date_time_format')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="time-format" class="control-label">Time Format<small class="text-danger required">*</small></label>
                           <select class="form-control ts" name="time_format" id="time-format">
                              <option value="" selected="selected" disabled="disabled">Select Time Format</option>
                              @foreach(config('larasnap.settings.time_format') as $key => $value)
                              <option value="{{ $value }}" @if(old('time_format',$setting_db_values['time_format'])==$value ) selected @endif>{{ date($value)}}</option>
                              @endforeach
                           </select>
                           @error('time_format')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="entries-per-page" class="control-label">Entries Per Page<small class="text-danger required">*</small></label>
                           <input name="entries_per_page" type="number" id="entries-per-page" class="form-control" min="1" max="200" value="{{ old('entries_per_page', $setting_db_values['entries_per_page']) }}">
                           @error('entries_per_page')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                        <label for="admin_notification" class="control-label">Admin Notification Email<small class="text-danger required">*</small></label><br>
                        <input type="text" id="tagas" name="admin_notification[]" class="form-control" required="required" data-role="tagsinput" value = "{{ old('admin_notification', isset($setting_db_values['admin_notification']) ? $setting_db_values['admin_notification'] : 'NA' )}}"/>				
                        </div>
                     </div>
                     {{--<div class="col-md-4">
                        <div class="form-group">
                           <label for="default-user-role" class="control-label">Default User Role<small class="text-danger required">*</small></label>
                           <select class="form-control ts"  name="default_user_role" id="default-user-role" >
                              <option value="0"  selected="selected">No Role</option>
                              @foreach($roles as $key => $role)
                                <option value="{{ $role->id }}" @if(old('default_user_role',$setting_db_values['default_user_role'] ?? '') == $role->id ) selected @endif >{{ $role->label }}</option>
                     @endforeach
                     </select>
                     @error('default_user_role')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
            </div>--}}
            <div class="col-md-12">
               <div class="form-group">
                  <input type="submit"  value="Update" class="btn btn-primary">
               </div>
            </div>
         </div>
         </form>
         <p>Time Zone: {{ config('app.timezone') }}</p>
      </div>
   </div>
</div>
</div>
</div>
<!-- Page Content End-->
@endsection
@section('script')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script src="custom_tags_input.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script>

$('#tags').tagsinput({
   confirmKeys: [13, 44],
   maxTags: 20
});
</script>
@endsection