<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <title>Log in</title>
        <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
    </head>
    <body>
        <div class="center">
            <h2>Login</h2>
            <p><i>Please fill in your credentials to login.</i></p>
            <form action="{{route('login')}}" method="post">
            @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">    
                    @error('username')
                    <span class="help-block">{{$message}}</span>
                    @enderror       
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
            </form>
        </div>    
    </body>
</html>