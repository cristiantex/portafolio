<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        if ($request->user === env('LOGIN_USER') && $request->password === env('LOGIN_PASS')) {
            $request->session()->put('logged_in', true);
            return redirect()->route('welcome');
        }

        return back()->withErrors([
            'user' => 'Credenciales inválidas',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('logged_in');
        return redirect()->route('login');
    }
}
