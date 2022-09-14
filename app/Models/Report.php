<?php

namespace App\Models;
use LaraSnap\LaravelAdmin\Traits\Filter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaraSnap\LaravelAdmin\Models\UserProfile;

class Report extends Model
{
    use HasFactory,Filter;
    protected $fillable=['user_id','work_mode','project_id','hours_spent','date','description'];
    public function user(){
        return $this->hasOne(\App\Models\User::class,'id','user_id');
    }
    public function userprofile(){
        return $this->hasOne(UserProfile::class,'user_id','user_id');
    }
    public function project(){
        return $this->hasOne(\App\Models\Project::class,'id','project_id');
    }
    public function reminder()
    {
        return $this->hasOne(\App\Models\Reminder::class, 'user_id','user_id');
    }
}
