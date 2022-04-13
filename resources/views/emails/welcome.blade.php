<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="x-apple-disable-message-reformatting"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title></title>
</head>
<body>
<h1>Welcome, {{$data['name']}} </h1>

<p>Login Page:</strong><a  href="{{ route('login')}}">  {{ route('login')}} </a> </p>
<p>Email:</strong> {{$data['email']}}</p>
<p>Username:</strong> {{$data['username']}}</p>
<p>Password:</strong> {{$data['pass']}}</p>
<br>
<p class="f-fallback sub">If you have any question, fill <a  href="#">Contact form</a> for help. </p>
<p >&copy; 2021 Dhb Graphics. All rights reserved.</p>
</body>
</html>
