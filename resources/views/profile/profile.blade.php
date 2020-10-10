@extends('templates.template', ['title' => 'Profile'])

@section('content')
<div class="page-header">
    <h1>My profile</h1>
</div>
<div class='container'>
    <div class="panel panel-success">
        <div class="panel-heading">Full name: {{$user -> fullname}}</div>
        <div class="panel-body">Email: {{$user -> email}}</div>
        <div class="panel-body">Phone number: {{$user -> phonenumber }}</div>
        <div class="panel-body">Account type: {{$user -> type }}</div>
    </div>
</div>

<div class="container">
    <a href="{{route('editProfile')}}" class="btn btn-primary">Edit profile</a>
    <a href="{{route('changePassword')}}" class="btn btn-info">Change password</a>
</div>

@endsection