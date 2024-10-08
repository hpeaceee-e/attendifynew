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
        $user = User::where('role', '!=', 1)->pluck('id')->toArray();

        $tepat = Attendance::whereRaw("TIME(`time`) < '08:00:00'")
            ->whereIn('enhancer', $user)
            ->get();

        $telat = Attendance::whereRaw("TIME(`time`) > '08:00:00'")
            ->whereIn('enhancer', $user)
            ->get();


        // dd($tepat);

        // Retrieve all attendances with their schedules
        $attendances = Attendance::with('schedule', 'user')
            ->whereHas('user', function ($query) {
                $query->where('role', '2'); // Assuming '2' is the role ID for 'pegawai'
            })
            ->get();

        // Process the attendances to group by date and format the data
        $attendancesGrouped = $attendances->groupBy('date')->map(function ($group) {
            $clockIn = null;
            $clockOut = null;
            $coordinate = null;
            $status = ''; // Default status as empty string

            foreach ($group as $attendance) {
                if ($attendance->status == 0) {
                    // Status 0 indicates 'Masuk'
                    $clockIn = \Carbon\Carbon::parse($attendance->time);
                    $coordinate = $attendance->coordinate;
                } elseif ($attendance->status == 1) {
                    // Status 1 indicates 'Pulang'
                    $clockOut = \Carbon\Carbon::parse($attendance->time);
                }
            }

            if ($clockIn && $group->first()->schedule) {
                $scheduledTime = \Carbon\Carbon::parse($group->first()->schedule->clock_in);

                // Compare actual clock-in time with scheduled time
                $status = $clockIn <= $scheduledTime ? 'Tepat Waktu' : 'Terlambat';
            }

            return [
                'clockIn' => $clockIn ? $clockIn->format('H:i') : '-',
                'clockOut' => $clockOut ? $clockOut->format('H:i') : '-',
                'coordinate' => $coordinate,
                'status' => $status,
                'userName' => $group->first()->user->name,
                'date' => \Carbon\Carbon::parse($group->first()->date)->format('d M Y'),
            ];
        });

        return view('pages.admin.attendance.kelolakehadiranpegawai', compact('attendancesGrouped', 'attendances', 'telat', 'tepat'));
    }

    public function filtertanggal() {}


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
        return redirect()->route('pegawai.attendance')->with('success', 'Kehadiran berhasil disimpan.');
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

    public function cetakkehadiranmasuk($id)
    {
        $attendance = Attendance::where('id', $id)
            ->where('status', 0)
            ->firstOrFail(); // Mengambil data yang ada, atau gagal jika tidak ditemukan

        // dd($attendance); // Cek apakah data ditemukan

        $coordinates = explode(',', $attendance->coordinate);
        $latitude = $coordinates[0] ?? null;
        $longitude = $coordinates[1] ?? null;

        return view('pages.admin.attendance.printkehadiran-masuk', compact('attendance', 'latitude', 'longitude'));
    }


    public function cetakkehadirankeluar($id)
    {
        $attendance = Attendance::where('id', $id)
            ->where('status', 1)
            ->firstOrFail(); // Mengambil data yang ada, atau gagal jika tidak ditemukan

        // dd($attendance); // Cek apakah data ditemukan

        // Mengolah string coordinate menjadi array
        $coordinates = explode(',', $attendance->coordinate);
        $latitude = $coordinates[0] ?? null;
        $longitude = $coordinates[1] ?? null;

        // Tampilkan tampilan print
        return view('pages.admin.attendance.printkehadiran-keluar', compact('attendance', 'latitude', 'longitude'));
    }
}
