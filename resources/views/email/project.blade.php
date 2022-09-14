
Hi {{ ucwords($users->full_name)  }},<br><br>

You have been assigned in new project !!!.<br><br>

<b>Please find project name below:</b><br><br>

Project name: {{ $project->project_name }}<br>
Allocated hours: {{$project->allocated_hours}}<br>
Deadline date: {{date('d-m-Y',strtotime($project->end_date))}}<br><br>


Regards,<br>
Zaigo Infotech<br>
<br>
<img src="https://www.zaigoinfotech.com/wp-content/uploads/2020/11/logo.png" width="150px"/>


