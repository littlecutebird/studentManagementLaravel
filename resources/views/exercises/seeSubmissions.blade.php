@extends('templates.template', ['title' => 'See submissions'])

@section('content')
<div class="page-header">
    <h1>See student's submissions</h1>
</div>
<div class='container'>
    <div class="panel panel-success">
        <div class="panel-heading">{{$exercise -> title}}</div>
        <div class='panel-body'>{{$exercise -> description}}</div>
        <div class="panel-body"><a role='button' class='btn btn-warning' href='{{asset($exercise -> file_path)}}'>Statement</a></div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Student submissions</div>
        <div class="panel-body">
        @foreach ($submissions as $submission)
            <div class='panel panel-info'>
                <div class='panel-heading'>{{$submission -> user -> fullname}}</div>
                <div class='panel-body'>{{$submission -> submit_time}}</div>
                <div class='panel-body'><a role='button' class='btn btn-warning' href='{{asset($submission -> file_path)}}'>File submission</a></div>
            </div> 
        @endforeach
        </div>
       
    </div>
</div>
@endsection