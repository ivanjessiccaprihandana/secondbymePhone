<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $input = $request->validate(['login' => ['required', 'string'], 'password' => ['required']]);
        $email = strtolower($input['login']) === 'admin' ? 'admin@secondbymephone.id' : $input['login'];
        $credentials = ['email' => $email, 'password' => $input['password']];
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['login' => 'Username/email atau password tidak sesuai.'])->onlyInput('login');
        }
        $request->session()->regenerate();

        return redirect()->intended(route('admin.products.index'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
