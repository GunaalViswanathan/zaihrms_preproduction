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

 <select name="category" id="category" class="form-control ml-10" onchange="filterByID(this.value)">
     <option selected  value="all">Select Category</option>
     @php
        $category= \LaraSnap\LaravelAdmin\Models\Category::where('name','it-declaration')->first()
     @endphp
     @foreach ($category->childCategory as $childcategory)
         <option value="{{ $childcategory->id }}" {{$filters['category']==$childcategory->id?'selected':""}}>{{ $childcategory->label }}</option>
     @endforeach
 </select>


