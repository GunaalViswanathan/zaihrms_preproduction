<?php
namespace App\Filters;

use Carbon\Carbon;
use DB;
use LaraSnap\LaravelAdmin\Filters\Filters;

class ItdeclarationFilters extends Filters
{
    public function sort_by($type){
        return $this->builder->orderBy('id', (!$type || $type == 'latestfirst') ? 'desc' : 'asc');
    }
    public function category($term='all'){
        if($term!='all'){
            return $this->builder->where('category_id',$term);
        }
    }


}
