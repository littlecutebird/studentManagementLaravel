@extends('templates.template', ['title' => 'Add new student'])

@section('content')
<div class="container">
    <div class="center">
        <h2>Sign up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="{{route('addStudent')}}" method="post">
        @csrf
            @if (session() -> has('addSuccess'))
            <div class='alert alert-success'>Add new student success!</div>
            @endif
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
                @error('username')
                <span class='help-block'>{{$message}}</span>    
                @enderror
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                <span class='help-block'>{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                @error('confirm_password')
                <span class='help-block'>{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Full name</label>
                <input type="text" name="fullname" class="form-control">
                @error('fullname')
                <span class='help-block'>{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
                @error('email')
                <span class='help-block'>{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Phone number</label>
                <input type="text" name="phonenumber" class="form-control">
                @error('phonenumber')
                <span class='help-block'>{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" name='submit' class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>   
</div>
@endsection