<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaraSnap\LaravelAdmin\Traits\Filter;

class Employee extends Model
{
    use Filter, SoftDeletes, HasFactory;
}

