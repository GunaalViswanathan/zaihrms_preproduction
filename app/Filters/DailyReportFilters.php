<?php

namespace App\Filters;
use Carbon\Carbon;
use LaraSnap\LaravelAdmin\Filters\Filters;
use DB;

class DailyReportFilters extends Filters
{
    public function sort_by($sort)
    {
        return $this->builder->orderBy('id', (!$sort || $sort == 'latestfirst') ? 'desc' : 'asc');
    }
    public function project_name($project){
        if ($project != 'all') {
            return $this->builder->where('project_id', $project);
        }
    }
    public function resources($resource){
        if ($resource != 'all') {
            return $this->builder->where('user_id', $resource);
        }
    }
    public function from_date($fromDate){
        if ($fromDate != 'all') {
            return $this->builder->whereDate('date', '>=', Carbon::parse($fromDate)->format('Y-m-d'));
        }
    }
    public function to_date($toDate){
        if ($toDate != 'all') {
            return $this->builder->whereDate('date', '<=', Carbon::parse($toDate)->format('Y-m-d'));
        }
    }
    
    
}



