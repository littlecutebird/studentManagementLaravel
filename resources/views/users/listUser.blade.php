@extends('templates.template', ['title' => 'List user'])

@section('content')
<div class="page-header">
    <h1>List user in this website</h1>
</div>

{{--Display add button for teacher--}}
@if (Auth::user() -> type == "teacher") 
<div class='container'>
<a class='btn btn-success' href='{{route('addStudent')}}'>Add new student</a>
</div>
<br>
@endif

{{--List of user --}}
<div class="container panel-group">   
    @if (session() -> has('deleteSuccess'))
    <div class='alert alert-danger'>Delete student profile success!</div>
    @endif
@foreach ($users as $user)
    <div class='panel panel-success'>
        <div class='panel-heading'>Full name: {{$user -> fullname}} </div>
        <div class='panel-body'>Email: {{$user -> email}} </div>
        <div class='panel-body'>Phone number: {{$user -> phonenumber }} </div>
        <div class='panel-body'>Account type: {{$user -> type }} </div>
        <div class='panel-body'>
            <a class='btn btn-info' href='{{route('sendMsg', ['id' => $user -> id])}}#bottomPage'>Message me</a>
        {{--Teacher can edit or delete student account--}}
        @if (Auth::user() -> type == "teacher" && $user -> type == 'student') 
        <button class='btn btn-danger' style='float:right;' onclick="return confirm('Are you sure you want to delete this account?')"><a style='color:white' href='{{route('deleteStudentProfile', ['id' => $user -> id]) }}'>Delete account</a></button>
        <a class='btn btn-primary' href='{{route('editStudentProfile', ['id' => $user -> id])}}' style='float:right'>Edit profile</a>
        @endif
        </div>
    </div>
@endforeach
</div>

@endsection