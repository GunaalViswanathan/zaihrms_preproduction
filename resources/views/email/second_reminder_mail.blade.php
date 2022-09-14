Hi {{ ucwords(reportingName($reminder->user_id)) }},<br><br>

You didn't update the daily report on {{ date('d-m-Y',strtotime(\App\Models\Reminder::where('user_id',$reminder->user_id)->first()->reminder_date))}} 
 and {{Carbon\Carbon::yesterday()->format('d-m-Y')}}. Kindly update and follow the process.<br><br>
Thanks,<br>
HR Team