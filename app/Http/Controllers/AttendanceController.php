<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function kehadiran()
    {
        // Retrieve all attendances with their schedules
        $attendances = Attendance::with('schedule', 'user')
            ->whereHas('user', function ($query) {
                $query->where('role', '2'); // Assuming '2' is the role ID for 'pegawai'
            })
            ->get();

        return view('pages.admin.attendance.kelolakehadiranpegawai', compact('attendances'));
    }


    public function cetakkehadiran()
    {
        $attendances = Attendance::whereHas('user', function ($query) {
            $query->where('role', '2'); // Gantilah 'pegawai' dengan ID role untuk pegawai jika menggunakan angka.
        })->get();

        return view('pages.admin.attendance.printkehadiranpegawai', compact('attendances'));
    }

    // Tampilkan daftar kehadiran
    public function index()
    {
        $id = Auth::user()->id;
        // dd($id);
        $attendances = Attendance::where('enhancer', $id)->get();
        return view('pages.pegawai.attendance.index', compact('attendances'));
    }

    // Tampilkan halaman presensi
    public function create()
    {
        return view('pages.pegawai.attendance.create');
    }

    // Simpan data presensi
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:0,1',
            'coordinate' => 'required',
        ]);

        Attendance::create([
            'enhancer' => Auth::id(),
            'date' => now()->format('Y-m-d'),
            'time' => now(),
            'status' => $request->input('status'),
            'coordinate' => $request->input('coordinate'),
        ]);
        return redirect()->route('pegawai.attendance')->with('success', 'Kehadiran berhasil dicatat.');
    }

    // Cetak data kehadiran per pegawai
    public function print($id)
    {
        $attendance = Attendance::findOrFail($id);
        $id_user = Auth::user()->id;
        $name = User::where('id', $id_user)->value('name');
        // Mengolah string coordinate menjadi array
        $coordinates = explode(',', $attendance->coordinate);
        $latitude = $coordinates[0] ?? null;
        $longitude = $coordinates[1] ?? null;

        // Tampilkan tampilan print
        return view('pages.pegawai.attendance.print', compact('attendance', 'latitude', 'longitude', 'name'));
    }

    public function cetakkehadiranorang($id)
    {
        $attendance = Attendance::findOrFail($id);
        $id_user = Auth::user()->id;
        $name = User::where('id', $id_user)->value('name');
        // Mengolah string coordinate menjadi array
        // Mengolah string coordinate menjadi array
        $coordinates = explode(',', $attendance->coordinate);
        $latitude = $coordinates[0] ?? null;
        $longitude = $coordinates[1] ?? null;

        // Tampilkan tampilan print
        return view('pages.admin.attendance.printkehadiran-orang', compact('attendance', 'latitude', 'longitude', 'name'));
    }
}
