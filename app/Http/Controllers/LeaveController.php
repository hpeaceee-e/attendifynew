<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Schedule::get();
        return view('pages.admin.leave.kelolajadwalpegawai', compact('leaves'));
    }
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'required|date_format:H:i',
            'break' => 'required|date_format:H:i',
        ]);

        // Simpan data jadwal baru ke database
        $schedule = Schedule::create([
            'clock_in' => $request->input('clock_in'),
            'clock_out' => $request->input('clock_out'),
            'break' => $request->input('break'),
        ]);

        // Redirect kembali ke halaman kelola jadwal dengan pesan sukses
        return redirect()->route('admin.kelolajadwal')->with('success', 'Jadwal berhasil ditambahkan.');
    }
}
