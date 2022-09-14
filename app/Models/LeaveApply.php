<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApply extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'leave_type', 'leave_from', 'leave_to', 'permission_from', 'permission_to', 'no_of_days', 'reason', 'status', 'task_type', 'task_reason', 'task_plan','status_reason'];
    protected $appends = ['reporting_to'];

    public function getReportingToAttribute() {
        $user = User::where('id', $this->user_id)->first();
        return $user->reporting_to;
    }
}
