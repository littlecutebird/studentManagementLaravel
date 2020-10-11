@extends('templates.template', ['title' => 'List challenge'])

@section('content')
<div class="page-header">
    <h1>All Challenges</h1>
</div>


@if (Auth::user() -> type == 'teacher')

@if (session() -> has('addSuccess'))
<div class='container alert alert-success'>Add challenge success!</div>
@endif
@if (session() -> has('deleteSuccess'))
<div class='container alert alert-danger'>Delete challenge success!!</div>
@endif

<div class='container'>
    <a class='btn btn-success' href='{{route('addChallenge')}}'>Add new challenge</a>
</div>

@endif

@foreach ($challenges as $challenge)
<div class='container'>
    <h2>{{$challenge -> title}}</h2>
    <p>Hint: {{$challenge -> hint}}</p>
    <p>Deadline: {{$challenge -> deadline}}</p>
    @if (Auth::user() -> type == 'student')
    <a class='btn btn-danger' href='{{route('submitChallenge', ['challengeId' => $challenge -> id])}}'>Submit</a>
    @elseif (Auth::user() -> type == 'teacher')
    <form class='form-inline'>
        <a class='btn btn-danger btn-inline' href='{{route('deleteChallenge', ['challengeId' => $challenge -> id])}}' onclick="return confirm('Are you sure you want to delete this homework?')">Delete challenge</a>
    </form>
    @endif
</div>
@endforeach

@endsection