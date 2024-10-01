<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil data email dan password
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Coba autentikasi menggunakan kredensial
        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, cek role user
            $user = Auth::user();
            
            if ($user->role == 'admin') {
                return view('halaman/dashboard1');
            } elseif ($user->role == 'kasir') {
                return view('halaman/dashboard2');
            } else {
                // Jika role tidak sesuai
                return redirect()->route('login')->with('failed', 'Role tidak dikenali.');
            }
        } else {
            // Jika autentikasi gagal
            return redirect()->route('login')->with('failed', 'Email atau password salah.');
        }
    }

    public function logout()
    {
        // Proses logout
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil logout.');
    }
}
