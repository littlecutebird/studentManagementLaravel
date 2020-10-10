@extends('templates.template', ['title' => 'Submit exercise'])

@section('content')
<div class='page-header'>
    <h1>Submit homework</h1>
</div>
<div class='container'>
    <div class='row'>
        <div class='col-lg-6'>
            <div class='panel panel-primary'>
                <div class="panel-heading">{{$exercise -> title }}</div>
                <div class="panel-body"><i>{{$exercise -> description }}</i></div>
                <div class='panel-body'>Last modified time: {{$exercise -> updated_at }}</div>
                <div class='panel-body'>Deadline: {{ $exercise -> deadline }}</div>
                <div class='panel-body'><a class='btn btn-warning' href='{{asset('storage/'. $exercise -> file_path)}}'>Statement</a></div>
            </div>
        </div>
        <div class='col-lg-6'>
            <br>
            <form action='' method='post' enctype='multipart/form-data'>
            @csrf
                <div class='form-group'>
                    <label for='fileToUpload'>Select file to upload:</label>
                    <input class='form-control' type="file" name="fileToUpload" id="fileToUpload" required>
                    @error('fileToUpload')
                    <span class='help-block'>{{$message}}</span>
                    @enderror
                </div>
                <input class='btn btn-success' type="submit" value="Submit homework" name="submit">
            </form>

        </div>
    </div>
   
</div>

@endsection