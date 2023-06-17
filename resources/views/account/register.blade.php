<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div id="form-login" class="form-register">
		<div class="title-login">
			<p>Register</p>
		</div>

		<form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
            @csrf
			<input name="user_name" type="text" placeholder="User name" autofocus/>
			<input name="full_name" type="text" placeholder="Full name"/>
			<input name="password" type="password" placeholder="Password"/>
			<input name="password_confirmation" type="password" placeholder="Re Password"/>
            <input type="file" name="avatar" id="">
			{{-- <%
				if(request.getAttribute("Status") != null) {
			%>
				<span style="color: red;"><%=request.getAttribute("Status") %></span>
			<%} %> --}}
			<input type="submit" value="Register"/>
			<a href="{{ route('login') }}">Click here to Login</a>
		</form>
	</div>
</body>
</html>
