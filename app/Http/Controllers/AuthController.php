<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Ambil kredensial dari form
        $credentials = $request->only('username', 'password');

        // Cari user berdasarkan username
        $user = User::where('username', $credentials['username'])->first();

        // Periksa apakah user ditemukan dan password cocok
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Jika password cocok, login berhasil
            Auth::login($user);

            //tambahan session sesuai user dan id role



            return redirect()->route('dashboard');
        }

        // Jika login gagal
        return back()->with('error', 'Username atau Password Salah');
    }
}
