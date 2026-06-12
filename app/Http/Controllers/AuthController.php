<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('register');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255|min:2|unique:users,name',
            'email'      => 'required|string|email|max:255|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
            'role'       => 'required|string|in:user,admin',
            'admin_code' => 'nullable|string',
        ], [
            'name.required'           => 'Nama lengkap wajib diisi.',
            'name.unique'             => 'Pengguna sudah terdaftar. Silakan gunakan nama atau email lain.',
            'email.required'          => 'Email wajib diisi.',
            'email.email'             => 'Format email tidak valid.',
            'email.unique'            => 'Pengguna sudah terdaftar. Silakan gunakan nama atau email lain.',
            'password.required'       => 'Password wajib diisi.',
            'password.min'            => 'Password minimal 8 karakter.',
            'password.confirmed'      => 'Konfirmasi password tidak cocok.',
            'role.required'           => 'Tipe akun wajib dipilih.',
            'role.in'                 => 'Tipe akun tidak valid.',
            'admin_code.string'       => 'Kode admin harus berupa teks.',
        ]);

        $role = $request->input('role') === 'admin' ? 'admin' : 'user';

        if ($role === 'admin') {
            $adminCode = env('ADMIN_REGISTRATION_CODE', 'ADMIN123');

            if ($request->input('admin_code') !== $adminCode) {
                return back()
                    ->withInput($request->only('name', 'email', 'role'))
                    ->withErrors(['admin_code' => 'Kode admin tidak valid.']);
            }
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $role,
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun Anda berhasil dibuat. Silakan masuk menggunakan akun Anda.');
    }
}