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

    .form-control {
        color: #6e707e !important;
    }
</style>
<!-- Page Heading  Start-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Daily Report</h1>
</div>
<!-- Page Heading End-->
<!-- Page Content Start-->
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-body">
                    <a href="{{ route('project.index') }}" title="Back to Project List" class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-arrow-left"></i> Back to Project List</a>
                    <form method="POST" action="{{route('project.daily_report_store')}}" enctype="multipart/form-data" id="my_form" class="form-horizontal" autocomplete="off">
                        <div>
                            <input type="button" id='add_details' style="float: right;" value="Add More" class="btn btn-primary">
                        </div>
                        @csrf
                        <div class='project_details'>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="work_mode" class="control-label">Work Mode<small class="text-danger required">*</small></label>
                                        @if(config('larasnap.module_list.work-mode'))
                                        <select name="rows[0][work_mode]" id="work_mode" onchange="static(this.value)" class="form-control dropdown-toggle work_mode" required>
                                            <option value="">Select Work Mode</option>
                                            @foreach (config('larasnap.module_list.work-mode') as $type => $option)
                                            <option @if(old('work_mode')==$option['label']) selected @endif value="{{ $type }}">{{ $option['label'] }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                        @error('work_mode')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="project_name" class="control-label">Project Name<small class="text-danger required">*</small></label>
                                        <select name="rows[0][project_name]" id="project_name" disabled="disabled" class="form-control project_name" required>
                                            <option value="">Select Project</option>
                                            @foreach($project as $name)
                                            <option @if(old('project_name')==$name) selected @endif value="{{$name->id}}">{{ $name->project_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date" class="control-label">Date<small class="text-danger required">*</small></label>
                                        <input name="rows[0][date]" type="date" id="date" value="{{old('date',Carbon\Carbon::now()->format('Y-m-d')) }}" class="form-control" required>
                                        @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hours_spent" class="control-label">Hours spent<small class="text-danger required ">*</small></label>
                                        <select name="rows[0][hours_spent]" type="number" id="hours_spent" class="form-control" required>
                                            <option value="">Select Hours spent</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                        @error('hours_spent')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="control-label">Description<small class="text-danger required">*</small></label>
                                        <textarea name="rows[0][description]" type="text" id="description" value="{{ old('description') }}" class="form-control" required></textarea>
                                        @error('desription')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" style="float: left;" value="Save" id="submit" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Content End-->
@endsection
@section('script')
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    var i = 1;
    $("#add_details").click(function() {
        ++i;
        $(".project_details").append('<div class="details_' + i + '"><div class="row"><div class="col-md-4"><div class="form-group"><label for="work_mode" class="control-label">Work Mode<small class="text-danger required" >*</small></label><select name="rows[' + i + '][work_mode]" class="form-control work_mode_'+i+'" id="work_mode[' + i + ']" data-id = '+i+' onchange="filterByID(this)" required><option value="">Select Work Mode</option><?php foreach (config('larasnap.module_list.work-mode') as $type => $option) { ?><option value="<?php echo $type ?>"><?php echo $option['label'] ?></option><?php } ?></select></div></div><div class="col-md-4 "><div class="form-group"><label for="project_name" class="control-label">Project Name<small class="text-danger required" >*</small></label><select name="rows[' + i + '][project_name]" disabled="disabled" class="form-control project_name[' + i + ']" data-id = '+i+' id="project_name[' + i + ']" required><option value="">Select Project</option><?php foreach ($project as $name) { ?><option value="<?php echo $name->id ?>"><?php echo $name->project_name ?></option><?php } ?></select></div></div><div class="col-md-4"><div class="form-group"><label for="date" class="control-label">Date<small class="text-danger required" required>*</small></label><input name="rows[' + i + '][date]" type="date" id="date[' + i + ']" class="form-control" value="<?php echo Carbon\Carbon::now()->format('Y-m-d') ?>" required> </div> </div><div class="col-md-4"><div class="form-group"><label for="hours_spent" class="control-label">Hours spent<small class="text-danger required">*</small></label><select name="rows[' + i + '][hours_spent]" type="number" id="hours_spent[' + i + ']" class="form-control" required><option value="">Select Hours spent</option><option value = "1">1</option><option value = "2">2</option><option value = "3">3</option><option value = "4">4</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="description" class="control-label">Description<small class="text-danger required">*</small></label><textarea name="rows[' + i + '][description]" type="textarea" id="description[' + i + ']" class="form-control" value="{{ old('description ') }}" required></textarea>@error('desription ')<span class="text-danger">{{ $message }}</span>@enderror</div></div><div class="col-md-4 no-label"><div class="form-group"><input type="button" class="remove_details btn btn-danger" data_remove="' + i + '" value="Remove" ></div></div><div><div></div>')
    });
    $(document).on('click', '.remove_details', function() {
        var delete_id = $(this).attr('data_remove');
        console.log(delete_id);
        $('.details_' + delete_id).remove();
    });
    $(document).ready(function() {
        $('#my_form').validate();
        formValidate();
    });

    function formValidate() {
        var row = $('select[name^="rows"]');
        var rows = $('input[name^="rows"]');
        var rows = $('textarea[name^="rows"]');
        console.log(rows);
        console.log(row);
        row.filter('select[name$="[work_mode]"]').each(function() {
            $(this).rules("add", {

                required: true,
                messages: {
                    required: "Work Mode is Mandatory"
                }
            });
        });

        row.filter('select[name$="[hours_spent]"]').each(function() {
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Hours Spent is Mandatory"
                }
            });
        });
        rows.filter('input[name$="[date]"]').each(function() {
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Date is Mandatory"
                }
            });
        });
        rows.filter('textarea[name$="[description]"]').each(function() {
            $(this).rules("add", {
                required: true,
                messages: {
                    required: "Description is Mandatory"
                }
            });
        });
    }
    $("#submit").click(function() {
        formValidate();
    });
    function filterByID(work_name) {
       var id = work_name.getAttribute('data-id');
       var value = document.getElementById('work_mode['+id+']');
       var getvalue = value.options[value.selectedIndex].value;
        if (getvalue == 0) {
            document.getElementById('project_name['+id+']').removeAttribute('disabled');
        } else {
            document.getElementById('project_name['+id+']').setAttribute('disabled', 'disabled');
        }
    }
    function static(id) {
        if (id == 0) {
            $(".project_name").removeAttr("disabled");

        } else {
            $(".project_name").attr("disabled", "disabled");
        }
    }
</script>
@endsection