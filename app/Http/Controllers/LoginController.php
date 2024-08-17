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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            return redirect()->route('admin.pages.admin.dashboard');
        } else {
            return redirect()->route('auth.login')->with('failed', 'Username atau Password anda salah!');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('succes', 'Kamu berhasil signout');
    }
}
