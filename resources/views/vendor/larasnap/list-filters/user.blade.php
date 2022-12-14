 <style>
     .append {
         height: 35px;
         padding-top: 5px;
         position: absolute;
         top: 1px;
         right: 32px;
         border-left: 1px solid #d1d3e2;
         padding-left: 2%;
         background-color: #fff;
         cursor: pointer;
     }
 </style>@if(config('larasnap.module_list.user.sort_by'))
   <select name="sort_by"  id="sort-by" class="form-control" onchange="filter(this.value)">
      @foreach (config('larasnap.module_list.user.sort_by') as $option)
      <option @if($filters['sort_by'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
      @endforeach
   </select>
   @endif
   {{--@if(config('larasnap.module_list.user.filter.role'))
   <select name="user_role" id="role" class="form-control ml-10" onchange="filterByID(this)">
      <option value="all" >All Roles</option>
      <option value="no_role" @if($filters['user_role'] == 'no_role' ) selected @endif >No Role</option>
	  @foreach($roles as $name => $id)
      <option @if($filters['user_role'] == $id ) selected @endif value="{{ $id }}">{{ $name }}</option>
	  @endforeach
   </select>
   @endif--}}
   @if(config('larasnap.module_list.user.status'))
   <select name="user_status" id="users" class="form-control ml-10" onchange="filterByID(this)">
      @foreach (config('larasnap.module_list.user.status') as $option)
      <option @if($filters['user_status'] == $option['value']) selected @endif  value="{{ $option['value'] }}">{{ $option['label'] }}</option>
      @endforeach
   </select>
   @endif
   @if(config('larasnap.module_list.user.bulk_actions'))
   <select name="actions" id="actions" class="form-control ml-10" onchange="filterBulk(this.value)">
      <option selected disabled value="0">Bulk Actions</option>
      @foreach (config('larasnap.module_list.user.bulk_actions') as $option)
      <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
      @endforeach
   </select>
   @endif
   @if(config('larasnap.module_list.user.search'))
       <input type="text" name="search" id="search" placeholder="Search User..." class="form-control ml-10 search_fields" value="{{ $filters['search'] }}" data-toggle="tooltip" data-placement="top" title="Search by Name, Email">
       <div class="append">
           <i class="fa fa-search" onclick="submitSearch();"></i>
       </div>
   @endif
 <script>
     function submitSearch() {
         $('#list-form').submit();
     }
 </script>
