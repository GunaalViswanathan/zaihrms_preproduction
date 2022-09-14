<?php
namespace App\Filters;

use Carbon\Carbon;
use DB;
use LaraSnap\LaravelAdmin\Filters\Filters;

class HolidayFilters extends Filters
{
    public function sort_by($type){
        return $this->builder->orderBy('id', (!$type || $type == 'latestfirst') ? 'desc' : 'asc');
    }


    public function search($term = '') {
        if($term != '') {
          return $this->builder->where('holiday_name', 'LIKE', "%$term%");
        }
    }
    public function holiday($term = '') {
        if($term != '') {
            if($term=='year'){
                return $this->builder->whereYear('holiday_date',Carbon::now()->format('Y'));
            }
            elseif ($term=='month'){
                return $this->builder->whereMonth('holiday_date',Carbon::now()->format('m'));
            }
            elseif ($term=='week'){
                $startdate=Carbon::now()->startOfWeek();
                $enddate=Carbon::now()->endOfWeek();
                return $this->builder->whereBetween('holiday_date',[$startdate,$enddate]);

            }
        }
    }

}
