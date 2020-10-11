<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/mycss.css')}}">
    <link rel="stylesheet" href="{{asset('css/rain.css')}}">
</head>
<body class="back-row-toggle">
    <!-- Make it rain -->
    <div class="rain front-row"></div>
    <div class="rain back-row"></div>
    @include('templates.header')
    <div class="page-header">
        <h1>Hi, <b>{{Auth::user() -> fullname}}</b>. Welcome to our site.</h1>
    </div>
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src="{{asset('js/rain.js')}}"></script>
</body>
</html>