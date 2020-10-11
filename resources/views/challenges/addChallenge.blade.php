@extends('templates.template', ['title' => 'Add new challenge'])

@section('content')
<div class="page-header">
    <h1>Add new challenge</h1>
</div>
<div class='container'>
    <form action='{{route('addChallenge')}}' method='post' enctype='multipart/form-data'>
    @csrf 
        @if (session() -> has('error'))
        <div class='alert alert-danger'>{{Session::get('error')}}</div>
        @endif
        <div class='form-group'>
            <label for='title'>Title:</label>
            <input type='text' id='title' name='title' required><br>
            @error('title')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <div class='form-group'>
            <label for='hint'>Hint: </label>
            <input id='hint' name='hint' placeholder='Enter hint here' required><br>
            @error('hint')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <div class='form-group'>
            <label for='deadline'>Deadline:</label>
            <input type='datetime-local' id='deadline' name='deadline' required> <br>
            @error('deadline')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <div class='form-group'>
            <label for='fileToUpload'>Select file to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" required> <br>
            <span class='help-block'>The file must be a txt file, the filename should be the answer to the challenge</span>
        </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-success" value="Upload File" name="addNew">Add new challenge</button>  
            <button class='btn btn-warning' type='reset'>Reset</button>
            <a class='btn btn-primary' href='{{route('listChallenge')}}'>Cancel</a>
        </div>
    </form>
</div>
@endsection