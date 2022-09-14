<?php
namespace App\Filters;

use Carbon\Carbon;
use DB;
use LaraSnap\LaravelAdmin\Filters\Filters;

class AnnouncementFilters extends Filters
{
    public function sort_by($type){
        return $this->builder->orderBy('id', (!$type || $type == 'latestfirst') ? 'desc' : 'asc');
    }


    public function search($term = '') {
        if($term != '') {
          return $this->builder->where('title', 'LIKE', "%$term%");
        }
    }

}
