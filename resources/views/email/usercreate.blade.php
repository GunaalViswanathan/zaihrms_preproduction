Hi {{ ucwords($user->full_name)  }},<br><br>

Your profile has been created !!!.<br><br>

Please find User name and password below:<br><br>

Username: {{ $user->email }}<br><br>
Password: {{ $password }}<br><br>
Click <a href = "{{route('login')}}">here</a> to login. <br><br>
After you've logged in, change your password.<br><br>

Regards,<br>
Zaigo Infotech<br>
<br>
<img src="https://www.zaigoinfotech.com/wp-content/uploads/2020/11/logo.png" width="150px"/>
