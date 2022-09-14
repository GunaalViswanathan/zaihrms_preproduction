<?php

use Carbon\Carbon;

if (! function_exists('validateErrorObj')) {
	function validateErrorObj($errors)
	{
        $transformed = [];
        foreach ($errors as $field => $messages) {
            $transformed[$field] = $messages[0];
        }
        return $transformed;
	}
}
if (! function_exists('reportingName')) {
    function reportingName($userId) {
        $user = \App\Models\User::where('id', $userId)->first();
        $name = isset($user->full_name) ? $user->full_name : '';
        return $name;
    }
}

if (! function_exists('reportingEmail')) {
    function reportingEmail($userId) {
        $user = \App\Models\User::where('id', $userId)->first();
        $email = isset($user->email) ? $user->email : '';
        return $email;
    }
}

if (! function_exists('loginUserRole')) {
    function loginUserRole($userId) {
        $user = \App\Models\RoleUser::where('user_id', $userId)->first();
        $role = \LaraSnap\LaravelAdmin\Models\Role::where('id', $user->role_id)->first();
        return $role->label;
    }
}

if (! function_exists('dateDiffInDays')) {
    function dateDiffInDays($date1, $date2)
    {
        $diff = strtotime($date2) - strtotime($date1);
        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return abs(round($diff / 86400));
    }
}

if (! function_exists('dateFormat')) {
    function dateFormat($date = '', $format='Y-m-d') {
        return Carbon::parse($date)->format($format);
    }
}
if (! function_exists('dateIncludeDays')) {
    function dateIncludeDays($date, $numberOfDays, $format='Y-m-d') {
        return Carbon::parse($date)->addDays($numberOfDays)->format($format);
    }
}

if (! function_exists('hourCalculate')) {
    function hourCalculate($start_time, $end_time) {
        $time1 = strtotime($start_time);
        $time2 = strtotime($end_time);
        $difference = number_format(abs($time2 - $time1) / 3600, 2);
        return $difference;
    }
}

if (! function_exists('projectName')) {
    function projectName($projectId) {
        $project = \App\Models\Project::where('id', $projectId)->first();
        $name = isset($project->name) ? $project->name : '';
        return $name;
    }
}

if (! function_exists('taskType')) {
    function taskType($taskType) {
        $type = $taskType == 1 ? 'Why Business Critical' : ($taskType == 2 ? 'Why Time Critical' : 'Why Both Business Critical & Time Critical');
        return $type;
    }
}
if(! function_exists('projectStatus')){
    function projectStatus($projectStatus = null) {
        $project = config('larasnap.module_list.user.project-status');
        $projectName = isset($project[$projectStatus]['label']) ? $project[$projectStatus]['label'] : null;
        return $projectName;
        
    }
}
if(! function_exists('projectType')){
    function projectType($projectType = null) {
        $project_type = config('larasnap.module_list.user.project-type');
        $projectIndex = isset($project_type[$projectType]['label']) ? $project_type[$projectType]['label'] : null;
        return $projectIndex;
        
    }
}
if(! function_exists('workMode')){
    function workMode($workMode = null){
        $work_mode = config('larasnap.module_list.work-mode');
        $workIndex = isset($work_mode[$workMode]['label']) ? $work_mode[$workMode]['label'] : null;
        return $workIndex;
    }
}
?>
