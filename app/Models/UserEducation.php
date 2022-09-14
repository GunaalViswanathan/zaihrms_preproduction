<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    protected $table = 'user_educational_details';

    protected $fillable = [
        'user_id', 'institute_name', 'qualification', 'passing_year', 'percentage_score',
    ];
}
