<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logincontroller extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user(); // 🔥 INI YANG KURANG

        if ($user->role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        }

        return redirect()->route('home');
    }

    return back()->with('error', 'Email atau password salah');
}
}