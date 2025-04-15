<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login'); // Pastikan file ini ada di resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return $this->authenticated($request, $user);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect('/dashboard-admin');
        } elseif ($user->role === 'kasir') {
            return redirect('/dashboard-kasir');
        } elseif ($user->role === 'pemilik') {
            return redirect('/dashboard-pemilik');
        }

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        // Hapus sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
    
}
