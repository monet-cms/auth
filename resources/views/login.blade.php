<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
    </head>
    <body>
        <form method="POST" action="{{route('login.authenticate')}}">
            @csrf

            <label>
                <span>Email address</span>
                <input type="email" name="email" value="{{old('email')}}"/>

                @error('email')
                <span>{{$message}}</span>
                @enderror
            </label>


            <label>
                <span>Password</span>
                <input type="password" name="password"/>

                @error('password')
                <span>{{$message}}</span>
                @enderror
            </label>

            <div>
                <button type="submit">
                    Login
                </button>
            </div>
        </form>
    </body>
</html>