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

            <input name="user_name" type="text" placeholder="User name" autofocus value="{{ old('user_name') }}"/>
            @error('user_name')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <input name="password" type="password" placeholder="Password" />
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            <div class="rememberMe">
                <input type="checkbox" />
                <p>Remember Me</p>
            </div>

            @error('error')
                <span style="color: red;">{{ $message }}</span>
            @enderror

            @if(session('success'))
                <span style="color: green;">{{ session('success') }}</span>
            @endif
            <input type="submit" value="Login" />
            <a href="{{ route('register') }}">Click here to Register</a>
        </form>
    </div>
</body>

</html>
