<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFamily extends Model
{
    protected $table = 'user_family_details';

    protected $fillable = [
        'user_id', 'father_name', 'mother_name', 'marital_status', 'date_of_married', 'spouse_name', 'no_of_children',
    ];
}
