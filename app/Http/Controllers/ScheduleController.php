<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ScheduleDayM;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Ambil jadwal berdasarkan schedule_id pengguna yang login, dan load hari-harinya
        $schedules = Schedule::where('id', $user->schedule)->with('days')->get();

        // Tampilkan view dengan data jadwal dan hari
        return view('pages.pegawai.schedule.index', compact('schedules'));
    }
}
