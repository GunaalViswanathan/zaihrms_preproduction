<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaraSnap\LaravelAdmin\Models\Category;
use LaraSnap\LaravelAdmin\Traits\Filter;

class Itdeclaration extends Model
{
    use HasFactory,Filter;
    protected $guarded = [];
    public function category(){

        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function childcategory(){

        return $this->belongsTo(Category::class,'sub_category_id','parent_category_id');
    }
    public function itdeclarationdocument(){

        return $this->hasMany(ItdeclarationDocument::class,'itdeclaration_id','id');
    }
}
