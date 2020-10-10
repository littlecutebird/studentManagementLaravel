<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><img src='{{asset('img/cat-logo.jpg')}}' alt='website logo' height='30' width='30'></a>
        </div>
        <ul class="nav navbar-nav">
            <li @if (Request::is('/')) class="active" @endif><a href="{{route('index')}}">Home</a></li>
            <li @if (Request::is('exercises*')) class="active" @endif><a href="{{route('listExercise')}}">Exercise</a></li>
            <li @if (Request::is('challenges*')) class="active" @endif><a href="#">Challenge</a></li>
            <li @if (Request::is('users*')) class="active" @endif><a href="{{route('listUser')}}">List user</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li @if (Request::is('profile*')) class="active" @endif><a href="{{route('profile')}}"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            <li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav>