<?php

namespace App\Filters;

use LaraSnap\LaravelAdmin\Filters\Filters;

class ProjectFilter extends Filters
{
    public function sort_by($sort)
    {
        return $this->builder->orderBy('id', (!$sort || $sort == 'latestfirst') ? 'desc' : 'asc');
    }

    public function project_type($type)
    {
        if ($type != 'all') {
            return $this->builder->where('project_type', $type);
        }
    }

    public function project_status($status)
    {
        if ($status != 'all') {
            return $this->builder->where('project_status', $status);
        }
    }

    public function search($search = null)
    {
        if ($search != null) {

            return $this->builder->where('project_name', 'LIKE', "%$search%")
                ->orWhere('client_name', 'LIKE', "%$search%");
        }
    }
    public function userid($userid)
    {
        if ($userid != 'all') {
            return $this->builder->whereRaw("find_in_set($userid,resource)");
        }
    }
    public function search_project($searchProject = null)
    {
        if ($searchProject != null) {
            return $this->builder->where('id', $searchProject);
        }
    }
    public function project_managing($managingProject){
        if($managingProject!= 'all'){
            return $this->builder->where('created_by',$managingProject)->get();
        }
    }
}
