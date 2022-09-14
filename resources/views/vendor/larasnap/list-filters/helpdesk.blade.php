@if(@loginUserRole(auth()->user()->id)!='Employee')
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

 @if(config('larasnap.module_list.ticket_status'))
     <select name="status"  id="status" class="form-control" onchange="filterByID(this.value)">
         <option value="" selected >Select Status</option>
         @foreach (config('larasnap.module_list.ticket_status') as $option)
             <option @if($filters['status'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
         @endforeach
     </select>
 @endif

@endif
   @if(config('larasnap.module_list.user.search'))
   <input type="text" name="search" placeholder="Search Ticket..." class="form-control ml-10" value="{{ $filters['search'] }}" data-toggle="tooltip" data-placement="top" title="Search by Ticket Id And Subject">
   @endif

