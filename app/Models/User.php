<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends \LaraSnap\LaravelAdmin\Models\User
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'reporting_to',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role(){
        return $this->hasOne(\App\Models\RoleUser::class);
    }

    public function userFamily(){
        return $this->hasOne(\App\Models\UserFamily::class);
    }
    public function userReporting(){
        return $this->hasOne(\App\Models\User::class, 'reporting_to', 'id');
    }
    public function report(){
        return $this->hasOne(\App\Models\Report::class, 'user_id', 'id');
    }
    public function userEducation(){
        return $this->hasMany(\App\Models\UserEducation::class, 'user_id', 'id');
    }
    public function userExperience(){
        return $this->hasMany(\App\Models\UserExperience::class, 'user_id', 'id');
    }
    public function userProfile(){
        return $this->hasOne(\LaraSnap\LaravelAdmin\Models\UserProfile::class, 'user_id', 'id');
    }
    public function reminder(){
        return $this->belongsTo(Reminder::class,'user_id','id');
    }
}
