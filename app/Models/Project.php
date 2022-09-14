<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaraSnap\LaravelAdmin\Traits\Filter;

class Project extends Model
{
    use HasFactory,Filter;

    public function projectResource()
    {
        return $this->hasMany('App\Models\ProjectResource', 'project_id', 'id');
    }
    public function report(){
        return $this->hasMany(App\Models\Report::class, 'id', 'project_id');

    }
    
}
