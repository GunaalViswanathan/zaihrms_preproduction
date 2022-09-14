<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaraSnap\LaravelAdmin\Models\Category;
use LaraSnap\LaravelAdmin\Traits\Filter;

class HelpDesk extends Model
{
    use HasFactory,Filter;

    protected $guarded=[];
    public function category(){

        return $this->belongsTo(Category::class);
    }
}
