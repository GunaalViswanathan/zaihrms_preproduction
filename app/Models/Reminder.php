<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaraSnap\LaravelAdmin\Models\UserProfile;


class Reminder extends Model
{
    use HasFactory;
    protected $fillable=['user_id','reminder_date'];
    public function userprofile(){
        return $this->hasOne(UserProfile::class,'user_id','user_id');
    }
    public function report()
    {
        return $this->belongsTo(Report::class, 'user_id','user_id');
    }
}

