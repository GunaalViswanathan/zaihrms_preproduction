Hi {{$name }},<br><br>

Here is the today work report,<br><br>

@foreach($report as $value => $data)
@if(isset($data['project_name']))
<b><u>Project Name: {{App\Models\Project::where('id', $data['project_name'])->first()->project_name}}</u></b><br>
<b>Hours Spent:</b>{{$data['hours_spent']}}<br>
<p style = " white-space: pre-wrap;">{{$data['description']}}</p><br><br>
@else 
<b><u>Work Mode: {{WorkMode($data['work_mode'])}}</u></b><br>
<b>Hours Spent:</b>{{$data['hours_spent']}}<br>
<p style = " white-space: pre-wrap;">{{$data['description']}}</p><br><br>
@endif
@endforeach
Thanks,<br>
{{ auth()->user()->full_name}}<br>
<br>
<img src="https://www.zaigoinfotech.com/wp-content/uploads/2020/11/logo.png" width="150px" />

