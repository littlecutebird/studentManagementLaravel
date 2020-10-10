@extends('templates.template', ['title' => 'Chat'])

@section('content')
<div class="page-header">
    <h1>Chat with {{$receiverUser -> fullname}}</h1>
</div>

<style>
    .well {
        margin:auto;
        font-size:15px;
        font-weight:550;
        color: #f3f3f3;
        border-bottom-left-radius: 1.3em;
        border-bottom-right-radius: 1.3em;
        border-top-left-radius: 1.3em;
        border-top-right-radius: 1.3em;
        background-color: #1fc8db;
        background-image: linear-gradient(140deg, #EADEDB 0%, #BC70A4 50%, #BFD641 75%);
    }
</style>
<div class='container'>
@foreach ($messages as $message)
    @if ($message -> sendId == Auth::user() -> id)
    <div class='media'>
        <div class='media-body text-right'>
            <h3 class='media-heading'>{{Auth::user() -> fullname}}</h3>
            <div class='well'>{{$message -> content}}</div>
            
            <a href='{{route('editMsg', ['id' => $message -> id, 'receiveId' => $message -> receiveId])}}'>
                <span class='glyphicon glyphicon-pencil' style='color:white'></span>
            </a>
            <a onclick="return confirm('Are you sure you want to delete this message?')" href='{{route('deleteMsg', ['id' => $message -> id])}}'>
                <span class='glyphicon glyphicon-minus' style='color:red'></span>
            </a> &#160
        </div>
        <div class='media-right media-top'>
            <img src='{{asset('img/sendMsg-logo.png')}}' class='media-object' style='width:80px'>
        </div>
    </div>
    @elseif ($message -> sendId = $receiverUser -> id)
    <div class='media'>
        <div class='media-left media-top'>
            <img src='{{asset('img/receiveMsg-logo.png')}}' class='media-object' style='width:80px'>
        </div>
        <div class='media-body'>
            <h3 class='media-heading'>{{$receiverUser -> fullname}}</h3>
            <div class='well'>{{$message['content']}}</div>           
        </div>
    </div>
    @endif
@endforeach
    <div id="bottomPage" >
        <br>
        <form action='{{route('sendMsg', ['id' => $receiverUser -> id])}}' method='post'>
        @csrf
            <div class="input-group">
                <input type="text" style='background: linear-gradient(to left, #ffefba, #ffffff);font-size:15px;font-weight:550;color: black;' class="form-control " placeholder="Send new messeage" name='messageContent' required>
                <span class="input-group-btn">
                    <button style="background: linear-gradient(to right, #f12711, #f5af19);" type="submit" name='newMessage' class="btn btn-default">
                        <span class="glyphicon glyphicon-send"></span>
                    </button>
                </span>
            </div>  
        </form>     
    </div>
    <br>
</div>

@endsection