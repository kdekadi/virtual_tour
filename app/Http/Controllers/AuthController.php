<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'], // Cek unik di tabel users
            'nomor_telp' => ['nullable', 'string', 'max:45'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
        ]);

        // Buat user baru
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'nomor_telp' => $request->nomor_telp,
            'password' => Hash::make($request->password), 
            'role' => 'pengunjung', 
        ]);

        event(new Registered($user));

        return redirect()->route('login')
                     ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->intended('/admin'); 
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); 
    }
}

