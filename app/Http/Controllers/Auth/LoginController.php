<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('layouts.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $auth = Auth::attempt($request->except('_token'));

        if ($auth) {
            return redirect()->route('home');
        }

        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
