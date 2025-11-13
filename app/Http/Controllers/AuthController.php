<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    // --- Method 1: Menampilkan Form ---
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // --- Method 2: Memproses Registrasi ---
    public function register(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'username' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'], // Cek unik di tabel users
            'nomor_telp' => ['nullable', 'string', 'max:45'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], 
        ]);

        // 2. Buat user baru
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'nomor_telp' => $request->nomor_telp,
            'password' => Hash::make($request->password), 
            'role' => 'pengunjung', 
        ]);

        // 3. (Opsional) Kirim event bahwa user baru terdaftar
        event(new Registered($user));

        // 4. Login-kan user yang baru daftar
        //Auth::login($user);

        // 5. Redirect ke halaman utama
        return redirect()->route('login')
                     ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses login
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. proses login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Cek Role User
            $user = Auth::user();
            if ($user->role == 'admin') {
                // Jika admin, arahkan ke dashboard Filament
                return redirect()->intended('/admin'); 
            } else {
                // Jika pengunjung, arahkan ke halaman utama
                return redirect()->intended('/');
            }
        }

        // 4. Jika login gagal
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
        return redirect('/'); // Arahkan ke halaman utama setelah logout
    }
}

