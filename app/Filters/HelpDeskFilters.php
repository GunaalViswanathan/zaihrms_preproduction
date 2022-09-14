<?php

namespace App\Filters;

use Carbon\Carbon;
use DB;
use LaraSnap\LaravelAdmin\Filters\Filters;

class HelpDeskFilters extends Filters
{
    public function sort_by($type)
    {
        return $this->builder->orderBy('id', (!$type || $type == 'latestfirst') ? 'desc' : 'asc');
    }


    public function search($term = '')
    {

        if ($term != '') {

            return $this->builder->orWhere('ticket_id', 'LIKE', "%$term%")->orWhere('subject', 'LIKE', "%$term%");
        }
    }

    public function status($term='')
    {
        if ($term != '') {
            return $this->builder->where('status', $term);
        }
    }

    public function priority($term = '')
    {

        if ($term != '') {
            return $this->builder->where('priority', $term);
        }
    }



}
