<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;

class UserControllers1 extends Controller
{
    public function index()
    {
        // Mengambil data pegawai dari database
        $data = User::with('role', 'schedule')->get();
        $cuti = Leave::all();  // Gunakan Leave::all() alih-alih Leave::get()
        $attendances = Attendance::all();
        return view('pages.pegawai.dashboard', compact('data', 'cuti', 'attendances'));
    }

    public function profilakun()
    {
        // Mengambil data pegawai dari database
        $data = User::with('role', 'schedule')->get();

        return view('pages.pegawai.profil.profilakun', compact('data'));
    }

    public function profilbiodata()
    {
        // Mengambil data pegawai dari database
        $data = User::with('role', 'schedule')->get();

        return view('pages.pegawai.profil.profilbiodata', compact('data'));
    }

    public function profilidentitas()
    {
        // Mengambil data pegawai dari database
        $data = User::with('role', 'schedule')->get();

        return view('pages.pegawai.profil.profilidentitas', compact('data'));
    }
}
