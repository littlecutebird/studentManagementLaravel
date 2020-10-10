<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function show()
    {
        return view('login');
    }

    public function authenticate(LoginRequest $requestFields)
    {
        // Returned validated fields also contain the csrf token,
        // therefore, we pick only username and password.
        $attributes = $requestFields->only(['username', 'password']);
    
        if (Auth::attempt($attributes)) {
            return redirect()->route('index');
        }
        else return redirect() -> route('login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return back();
    }
}
