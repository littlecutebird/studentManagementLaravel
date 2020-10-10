@extends('templates.template', ['title' => 'Edit profile'])

@section('content')
<div class="page-header">
    <h1>Edit profile</h1>
</div>
<div class="container">
    <form action="{{route('editProfile')}}" method="post">
    @csrf    
        @if (session() -> has('editSuccess'))
        <div class='alert alert-success'>Update profile success!</div>
        @endif
        <div class="form-group">
            <label>Email: </label>
            <input class="form-control" type="email" name="email" value="{{$user -> email}}">
            @error('email')
            <span class='help-block'>{{$message}}</span>  
            @enderror
        </div>
        <div class="form-group">
            <label>Phone number: </label>
            <input class="form-control" type="tel" name="phonenumber" value="{{$user -> phonenumber}}" pattern="[0-9]{7,10}">
            @error('phonenumber')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <button class="btn btn-success" type='submit'>Confirm</button>
    </form>
    
</div>
@endsection