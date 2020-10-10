@extends('templates.template', ['title' => 'List exercise'])

@section('content')
<div class="page-header">
    <h1>All exercises</h1>
</div>

@if (Auth::user() -> type == 'teacher')
<div class='container'>
    <a class='btn btn-success' href='{{route('addExercise')}}'>Add new exercise</a>
</div>
<br>
@endif

<div class="container panel-group">
    @if (session() -> has('deleteSuccess'))
    <div class='alert alert-danger'>Delete exercise success!</div>
    @endif
    @foreach ($exercises as $exercise)
    <div class='panel panel-primary'>
        <div class='panel-heading'>{{$exercise -> title}}</div>
        <div class='panel-body'>Deadline: {{$exercise -> deadline }}</div>
        @if (Auth::user() -> type == 'student')
        <div class='panel-body'>Status: {{isset($submitStatus[$exercise -> id]) ? 'Submitted' : 'Not done'}}</div>
        <div class='panel-body'><a class='btn btn-success' href='{{route('submitExercise', ['id' => $exercise -> id])}}'>Submit</a></div>
        @elseif (Auth::user() -> type == 'teacher')
        <div class='panel-body'>
            <form class='form-inline'>
                <a class='btn btn-info btn-inline' href='#'>See submissions</a>
                <a class='btn btn-danger btn-inline' href='{{route('deleteExercise', ['id' => $exercise -> id])}}' onclick="return confirm('Are you sure you want to delete this exercise?')">Delete exercise</a>
            </form>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection