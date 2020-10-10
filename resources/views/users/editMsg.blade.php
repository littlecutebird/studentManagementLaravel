@extends('templates.template', ['title' => 'Edit message'])

@section('content')
<div class="page-header">
    <h1>Edit message</h1>
</div>
<div class="container">
    <form action='{{route('editMsg', ['id' => $message -> id, 'receiveId' => $receiveId])}}' method='post'>
    @csrf
        <div class="input-group">
        <input type="text" style=' background: linear-gradient(to left, #ffefba, #ffffff);font-size:15px;font-weight:550;color: black;' class="form-control " placeholder="Send new messeage" name='messageContent' value='{{ $message -> content }}' required>
            <span class="input-group-btn">
                <button style="background: linear-gradient(to right, #f12711, #f5af19);" type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-send"></span>
                </button>
            </span>
         </div>  
    </form>    
</div>

@endsection