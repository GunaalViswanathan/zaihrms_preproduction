<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    protected $table = 'user_experience_details';

    protected $fillable = [
        'user_id', 'organization', 'designation', 'from_year', 'to_year',
    ];
}
