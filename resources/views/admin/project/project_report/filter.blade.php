@if(config('larasnap.module_list.user.sort-by'))
<select class="form-control" name="sort_by" id="sort-by" onchange="filter(this.value)">
    @foreach (config('larasnap.module_list.user.sort-by') as $option)
    <option @if($filters['sort_by']==$option['value']) selected @endif value="{{ $option['value'] }}">{{ $option['label'] }}</option>
    @endforeach
</select>
@endif
<select name="project_name" class="form-control " id="project" onchange="filterByID(this.value)">
    <option value="">Search By Project Name</option>
    @foreach($project as $name)
    <option @if($filters['project_name']==$name->id) selected @endif value="{{$name->id}}">{{ $name->project_name }}</option>
    @endforeach
</select>
@if(!userHasRole('employee'))
<select name="resources" class="form-control  ml-10" id="resource" onchange="filterByID(this.value)">
    <option value="">Search By Employee Name</option>
    @foreach($resources as $resource)
    <option @if($filters['resources']==$resource->id) selected @endif value="{{$resource->id}}">{{ $resource->full_name }}</option>
    @endforeach
</select>
</br>
@endif
<div class="col-md-12">
    Start Date
    <input type="date" class="form-control mt-2 mb-1" name="from_date" id="from_date" value="{{ $filters['from_date'] }}" />
    End Date
    <input type="date" class="form-control mt-2 mb-1" name="to_date" id="to_date" value="{{ $filters['to_date'] }}" />
</div>
@error('to_date')
<div class="text-danger">{{ $message }}</div>
@enderror
<input type="submit" value="Submit" class="btn btn-primary">
<a href="{{route('project.daily_report_index')}}" class="btn btn-danger" value="Reset">Reset</a>
<select name="export" class="form-control btn btn-dark" id="export" onchange="filterByID(this.value)">
    <option value="">Download As </option>
    <option><a value="XLSX" id="exportSubmitData">XLSX</a></option>
    <option><a value="PDF" id="exportSubmitData">PDF</a></option>
</select>
