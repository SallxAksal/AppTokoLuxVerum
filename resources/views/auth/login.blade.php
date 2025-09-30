<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="animation-container">
        <div class="acrylic-store"></div>
    </div>
    <div class="login-container">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autofocus />
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
