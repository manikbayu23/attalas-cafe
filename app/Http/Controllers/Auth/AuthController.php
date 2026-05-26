<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return in_array(Auth::user()->role, ['admin']) ? redirect()->route('admin.dashboard') : redirect('/'); // Ubah ke route tujuan
        }
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        // Validasi request
        $data = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ], [
            'required' => ':attribute wajib diisi.',
        ], [
            'login' => 'Username atau email',
            'password' => 'Password',
        ]);

        // Cek login menggunakan email atau username
        $loginField = filter_var($data['login'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'name';

        $credentials = [
            $loginField => $data['login'],
            'password' => $data['password'],
        ];

        // Proses login
        if (Auth::attempt($credentials)) {

            // Regenerate session (security)
            $request->session()->regenerate();

            return redirect()->intended(
                route('admin.dashboard')
            )->with('success', 'Selamat datang kembali!');
        }

        // Login gagal
        return back()
            ->withInput($request->only('login'))
            ->withErrors([
                'failed' => 'Username/email atau password salah.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
