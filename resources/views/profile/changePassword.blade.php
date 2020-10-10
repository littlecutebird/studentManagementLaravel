@extends('templates.template', ['title' => 'Change password'])

@section('content')
<div class='page-header'>
    <h1>Change password</h1>
</div>
<div class="container">
    <p>Please fill in your old and your new password</p>
    <form action="{{route('changePassword')}}" method="post" >
        @csrf
        @if (session() -> has('changeSuccess'))
        <div class='alert alert-success'>Change password success!</div>
        @endif
        <div class="form-group">
            <label for="oldPassword">Old password:</label>
            <input class="form-control" type="password" id="oldPassword" name="oldPassword" placeholder="Enter your old password" required>
            @error('oldPassword')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="newPassword">New password:</label>
            <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="Enter your new password" required>
            @error('newPassword')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm new password:</label>
            <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your new password" required>
            @error('confirmPassword')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Change password</button>
    </form>
    <script type="text/javascript">
        var password = document.getElementById("newPassword"), confirm_password = document.getElementById("confirmPassword");

        function validatePassword(){
          if(newPassword.value != confirmPassword.value) {
            confirmPassword.setCustomValidity("Passwords Don't Match");
          } else {
            confirmPassword.setCustomValidity('');
          }
        }

        newPassword.oninput = validatePassword;
        confirmPassword.oninput = validatePassword;
    </script>
</div>
@endsection