<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryReporter extends Model
{
    use HasFactory;

    protected $fillable = ['emp_id','primary_reporter_id'];
     protected $table = 'primaryreporters';
    public function employee(){
        return $this->hasOne(\LaraSnap\LaravelAdmin\Models\UserProfile::class);
    }

    public function primary_reporter(){
        return $this->hasOne(\LaraSnap\LaravelAdmin\Models\User::class);
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['employeecheckbox'] = json_encode($value);
    }

}
