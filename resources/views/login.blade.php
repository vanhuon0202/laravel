<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-form">
        <h1>Login</h1>
        @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <form action="/login" method="post">
            @csrf
            <label for="name" style="text-align: left;">Username:</label>
            <input type="text" name="name" id="name">

            <label for="password" style="text-align: left;">Password:</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Login">
        </form>
        <p class="text-center">
            Don't you have an account?<a href="{{ route('register') }}"> Sign up</a>
        </p>
    </div>
</body>

</html>