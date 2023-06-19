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
			<input name="user_name" type="text" placeholder="User name" autofocus value="{{ old('user_name') }}"/>
            @error('user_name')
                <span style="color: red;">{{ $message }}</span>
            @enderror

			<input name="full_name" type="text" placeholder="Full name" value="{{ old('full_name') }}"/>
            @error('full_name')
                <span style="color: red;">{{ $message }}</span>
            @enderror

			<input name="password" type="password" placeholder="Password"/>
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror

			<input name="password_confirmation" type="password" placeholder="Re Password"/>
            @error('password_confirmation')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <input type="file" name="avatar">
            @error('avatar')
                <span style="color: red;">{{ $message }}</span>
            @enderror

			<input type="submit" value="Register"/>
			<a href="{{ route('login') }}">Click here to Login</a>
		</form>
	</div>
</body>
</html>
