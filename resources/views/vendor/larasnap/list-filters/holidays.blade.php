 @if(config('larasnap.module_list.user.sort_by'))
   <select name="sort_by"  id="sort-by" class="form-control" onchange="filter(this.value)">
      @foreach (config('larasnap.module_list.user.sort_by') as $option)
      <option @if($filters['sort_by'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
      @endforeach
   </select>
   @endif
 @canAccess('holidays.destroy')
   @if(config('larasnap.module_list.user.bulk_actions'))
   <select name="actions" id="actions" class="form-control ml-10" onchange="filterBulk(this.value)">
      <option selected disabled value="0">Bulk Actions</option>
      @foreach (config('larasnap.module_list.user.bulk_actions') as $option)
      <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
      @endforeach
   </select>
   @endif
 @endcanAccess

 @if(config('larasnap.module_list.holidays'))
     <select name="holiday"  id="holiday" class="form-control" onchange="filterByID(this.value)">
         <option selected  value="0">Search By</option>
         @foreach (config('larasnap.module_list.holidays') as $option)
             <option @if($filters['holiday'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
         @endforeach
     </select>
 @endif

   @if(config('larasnap.module_list.user.search'))
   <input type="text" name="search" placeholder="Search Holiday..." class="form-control ml-10" value="{{ $filters['search'] }}" data-toggle="tooltip" data-placement="top" title="Search by holiday name">
   @endif
