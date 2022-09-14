<select name="reporting_to" id="reporting_to" class="form-control" onchange="filterByID(this.value)">
    <option selected value="">Select Reporting</option>
    @forelse($userFilter as $index => $cate)
        <option value="{{ $cate->id }}" {!! $filters['reporting_to'] == $cate->id ? 'selected' : '' !!} >{{ ucwords($cate->userProfile->first_name.' '.$cate->userProfile->last_name) }}</option>
    @empty
    @endforelse
</select>
@if(config('larasnap.module_list.user.sort_by'))
    <select name="sort_by"  id="sort-by" class="form-control" onchange="filter(this.value)">
        @foreach (config('larasnap.module_list.user.sort_by') as $option)
            <option @if($filters['sort_by'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
@endif
@if(config('larasnap.module_list.user.status'))
    <select name="user_status" id="user_status" class="form-control ml-10" onchange="filterByID(this)">
        @foreach (config('larasnap.module_list.user.status') as $option)
            <option @if($filters['user_status'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
@endif
@if(config('larasnap.module_list.user.bulk_actions'))
    <select name="actions" id="actions" class="form-control ml-10" onchange="filterBulk(this.value)">
        <option selected value="0">Bulk Actions</option>
        @foreach (config('larasnap.module_list.user.bulk_actions') as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
@endif
<a class="btn btn-warning" href="javascript:void(0)" id="exportSubmitData" data-toggle="tooltip" data-placement="top" title="Export Data">
    <i class="fa fa-download"></i>
</a>
