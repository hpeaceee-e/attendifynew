<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $data = [
            $loginType => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            // Cek peran pengguna setelah login berhasil
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.pages.admin.dashboard');
            } elseif (Auth::user()->role == 2) {
                return redirect()->route('pegawai.pages.pegawai.dashboard');
            }
        } else {
            return redirect()->route('auth.login')->with('failed', 'Username atau Password anda salah!');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('succes', 'Kamu berhasil Logout');
    }

    public function resetpassword()
    {
        return view('auth.resetpassword');
    }

    public function gantipassword(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        // Ganti password pengguna
        $user = auth()->user(); // Pastikan pengguna sudah login

        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return redirect()->route('succes')->with('status', 'Password berhasil diubah.');
    }
}
