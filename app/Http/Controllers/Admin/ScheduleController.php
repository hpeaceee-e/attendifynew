<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::get();
        return view('pages.admin.schedule.kelolajadwalpegawai', compact('schedules'));
    }

    public function create()
    {
        return view('pages.admin.schedule.tambahjadwal'); // Pastikan Anda menyesuaikan dengan nama view yang tepat
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'required|date_format:H:i',
            'break' => 'required|date_format:H:i',
        ]);

        // Simpan data jadwal ke database
        Schedule::create([
            'clock_in' => $request->input('clock_in'),
            'clock_out' => $request->input('clock_out'),
            'break' => $request->input('break'),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kelolajadwalpegawai')->with('success', 'Jadwal pegawai berhasil ditambahkan.');
    }

    public function show(Schedule $schedule)
    {
        // Tampilkan detail jadwal
    }

    public function edit(Request $request, $id)
    {
        $schedules = Schedule::find($id);

        return view('pages.admin.schedule.editjadwal', compact('schedules'));
    }

    public function update(Request $request, $id)
    {
        $schedules = Schedule::find($id);

        $request->validate([
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'required|date_format:H:i',
            'break' => 'required|date_format:H:i',
        ]);

        // Perbarui data jadwal di database
        $schedules->update([
            'clock_in' => $request->input('clock_in'),
            'clock_out' => $request->input('clock_out'),
            'break' => $request->input('break'),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kelolajadwal')->with('success', 'Jadwal pegawai berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        // Hapus jadwal
    }

    public function print()
    {
        return view('pages.admin.schedule.printjadwal');
    }
}
