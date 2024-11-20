<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Attendance;
use App\Models\Role;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\ScheduleDayM;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function kehadiran()
    {
        $user = User::where('role', '!=', 1)->pluck('id')->toArray();
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $schedule = Schedule::find($user->schedule);
        $jadwal = ScheduleDayM::where('schedule_id', $schedule->id)->get();

        // Retrieve all attendances for display
        $attendances = Attendance::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', '2'); // Assuming '2' is the role ID for 'pegawai'
            })
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();


        return view('pages.admin.attendance.kelolakehadiranpegawai', compact('attendances', 'jadwal'));
    }



    public function filterKehadiran(Request $request)
    {
        $user = User::where('role', '!=', 1)->pluck('id')->toArray();
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $schedule = Schedule::find($user->schedule);
        $jadwal = ScheduleDayM::where('schedule_id', $schedule->id)->get();

        // Ambil parameter filter tanggal dari request dan konversi formatnya
        $date = $request->input('date');
        if ($date) {
            // Konversi format tanggal dari 'dd M yyyy' ke 'Y-m-d'
            $date = Carbon::createFromFormat('d M Y', $date)->format('Y-m-d');
        }

        // Query untuk filter kehadiran berdasarkan tanggal saja
        $attendances = Attendance::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', '2'); // Asumsi '2' adalah role untuk 'pegawai'
            })
            ->when($date, function ($query, $date) {
                return $query->whereDate('date', $date);
            })
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        return view('pages.admin.attendance.kelolakehadiranpegawai', compact('attendances', 'jadwal'));
    }





    public function rekap()
    {
        $data = Attendance::select('enhancer')->distinct()->get();

        // dd($data);
        return view('pages.admin.attendance.rekapitulasi',compact('data'));
    }

    public function cetakrekap()
    {
        return view('pages.admin.attendance.cetakrekapitulasi');
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

        $userid = Auth::user()->id;
        $user = User::find($userid);
        $schedule = Schedule::find($user->schedule);
        $jadwal = ScheduleDayM::where('schedule_id', $schedule->id)->get();
        // dd($jadwal);

        $id = Auth::user()->id;
        // dd($id);
        $orang = Auth::user()->schedule;
        $jadwal = Schedule::where('id', $orang)->value('id');
        $jadwal_detail = ScheduleDayM::where('schedule_id', $jadwal)->get();
        $attendances = Attendance::where('enhancer', $id)->get();
        return view('pages.pegawai.attendance.index', compact('attendances', 'jadwal', 'jadwal_detail'));
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
