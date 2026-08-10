<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password yang Anda masukkan salah.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $name = Auth::user() ? Auth::user()->name : '';
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Diarahkan ke URL beranda (/)
        return redirect('/')
            ->with('success', 'Sampai jumpa kembali, ' . $name . '! Anda berhasil keluar.');
    }
}
