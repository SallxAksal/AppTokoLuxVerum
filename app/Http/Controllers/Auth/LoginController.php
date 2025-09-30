<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $password = $request->input('password');
        if ($password === 'luxverum0705') {
            $request->session()->regenerate();
            $request->session()->put('is_admin', true);
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Berhasil login, selamat datang!'], 200);
            }
            return redirect()->intended('/dashboard')->with('success', 'Berhasil login, selamat datang!');
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Password salah.'], 422);
        }
        return back()->with('error', 'Password salah.');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
