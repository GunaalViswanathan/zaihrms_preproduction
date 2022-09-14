
@if(config('larasnap.module_list.user.sort-by'))
<select class="form-control"  name="sort_by" id="sort-by" onchange="filter(this.value)">
    @foreach (config('larasnap.module_list.user.sort-by') as $option)
    <option @if($filters['sort_by']==$option['value']) selected @endif value="{{ $option['value'] }}">{{ $option['label'] }}</option>
    @endforeach
</select>
@endif
@if(!userHasRole('employee'))
<select name="project_managing" class="form-control  ml-10" id="project_managing" onchange="filterByID(this.value)">
    <option value="all">All</option>
    @foreach($project_managing as $users)
    <option @if($filters['project_managing']==$users->id) selected @endif value="{{$users->id}}">{{ $users->full_name }}</option>
    @endforeach
</select>
@endif

    @if(!userHasRole('employee'))
    @if(config('larasnap.module_list.user.search'))
    <input type="text" name="search"  placeholder="Search..." class="form-control" value="{{ $filters['search'] }}" data-toggle="tooltip" data-placement="top" title="Search by Client Name, Project Name">
    @endif
    @else
    @if(config('larasnap.module_list.user.search'))
    <select class="form-control js-example-basic-single" name="search_project" id="search_project"  onchange="filterByID(this.value)">
        <option value="">Select Project</option>
        @foreach ($projects as $option)        
        <option  value="{{ $option->id }}" @if($filters['search_project']==$option->id) selected @endif>{{$option->project_name}}</option>
        @endforeach
    </select>
    @endif
    @endif


@canAccess('project.index')
<a href="{{ route('project.index') }}"><button class=" btn btn-danger" value = "Reset" type="button">Reset<i aria-hidden="true"></i></button></a>
@endcanAccess

