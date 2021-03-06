<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFaceAuthsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        $secretCode = $googleAuthenticator->createSecret();
        $qrCodeUrl = $googleAuthenticator->getQRCodeGoogleUrl(
            auth() -> user() -> username, $secretCode, config("app.name")
        );

        session(["secret_code" => $secretCode]);

        return view("two_face_auths.index", compact("qrCodeUrl"));
    }

    public function enable(Request $request)
    {
        $this->validate($request, [
            "code" => "required|digits:6"
        ]);

        $googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
        $secretCode = session("secret_code");

        if (!$googleAuthenticator->verifyCode($secretCode, $request->get("code"), 0)) {
            return redirect() -> route("2fa_setting")->with("enable2FA_invalid", true);
        }

        $user = auth()->user();
        $user->secret_code = $secretCode;
        $user->save();
        session(["2fa_verified" => true]);

        return redirect() -> route("2fa_setting")->with("enable2FA_ok", true);
    }
}

