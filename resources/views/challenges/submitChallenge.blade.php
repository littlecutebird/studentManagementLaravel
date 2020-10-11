@extends('templates.template', ['title' => 'Submit challenge'])

@section('content')
<div class='page-header'>
    <h1>Submit answer</h1>
</div>
<div class='container'> 
    <h2>{{$challenge -> title}}</h2>
    <p>Hint: {{$challenge -> hint}}</p>
    <p>Deadline: {{$challenge -> deadline}}</p>
    <form action='{{route('submitChallenge', ['challengeId' => $challenge -> id])}}' method='post'>
    @csrf
        <div class="form-group">
            <label for="answer">Answer: </label>
            <input class='form-control' type="text" name="answer" id="answer" required>
            @if (Session() -> has('wrongAnswer'))
            <span class='help-block alert alert-danger'>Wrong answer!</span> 
            @endif
        </div>
        <button class='btn btn-danger' type="submit" name="submitChallenge">Submit answer</button>
        <a class='btn btn-primary' href='{{route('listChallenge')}}'>Back</a>
    </form>     
</div>
@endsection