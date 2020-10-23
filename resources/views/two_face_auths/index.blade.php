@extends('templates.template', ['title' => '2FA Setting'])

@section('content')
<div class='page-header'>
    <h1>Enable 2FA authentication</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        @if (session() -> has('enable2FA_invalid'))
        <div class='alert alert-danger'>Invalid code!!?</div>
        @endif
        @if (session() -> has('enable2FA_ok'))
        <div class='alert alert-success'>Enable 2FA success!</div>
        @endif
        @error('code')
        <div class='alert alert-danger'>{{$message}}</div>
        @enderror
        <form role="form" method="post" action="{{ route('enable_2fa_setting') }}">
            {{ csrf_field() }}
            <h2>Step 1: Scan barcode</h2>
            <p class="text-muted">
                Scan the image above with the two-factor authentication app on your phone.
            </p>
            <p class="text-center">
                <img src="{{ $qrCodeUrl }}" />
            </p>
            <h2>Step 2: Enter the six-digit code from the application</h2>
            <p class="text-muted">
                After scanning the barcode image, the app will display a six-digit code that you can enter below.
            </p>
            <div class="form-group">
                <input type="text" name="code" class="form-control" placeholder="123456">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Enable</button>
                <a href="{{ route('index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection