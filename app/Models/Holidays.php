<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaraSnap\LaravelAdmin\Traits\Filter;

class Holidays extends Model
{
    use HasFactory,Filter;
    protected $guarded = [];
}
