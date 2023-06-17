<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div id="form-login">
		<div class="title-login">
			<p>Please Sign In</p>
		</div>

		<form action="{{ route('login') }}" method="post">
            @csrf
			<input name="user_name" type="text" placeholder="User name" autofocus/>
			<input name="password" type="password" placeholder="Password"/>
			<div class="rememberMe">
				<input type="checkbox"/>
				<p>Remember Me</p>
			</div>
			{{-- <%
				if(request.getAttribute("Status") != null) {
			%>
				<span style="color: red;"><%=request.getAttribute("Status") %></span>
			<%} %> --}}
			<input type="submit" value="Login"/>
			<a href="{{ route('register') }}">Click here to Register</a>
		</form>
	</div>
</body>
</html>
