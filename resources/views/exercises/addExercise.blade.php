@extends('templates.template', ['title' => 'Add new exercise'])

@section('content')
<div class="page-header">
    <h1>Add new exercise</h1>
</div>
<div class='container'>
    <form action='{{route('addExercise')}}' method='post' enctype='multipart/form-data'>
    @csrf
        @if (session() -> has('addSuccess'))
        <div class='alert alert-success'>Add exercise success!</div>
        @endif
        <div class='form-group'>
            <label for='title'>Title:</label>
            <input type='text' id='title' name='title' required><br>
            @error('title')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <div class='form-group'>
            <label for='description'>Description</label>
            <textarea id='description' name='description' placeholder='Enter description here' required></textarea><br>
            @error('description')
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
            @error('fileToUpload')
            <span class='help-block'>{{$message}}</span>
            @enderror
        </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-success" value="Upload File" name="addNew">Add new homework</button>  
            <button class='btn btn-warning' type='reset'>Reset</button>
            <a class='btn btn-primary' href='{{route('listExercise')}}'>Cancel</a>
        </div>
        
    </form>
</div>
@endsection