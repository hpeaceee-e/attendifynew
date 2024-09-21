<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data pegawai dari database
        $data = User::with('role', 'schedule')->get();
        $cuti = Leave::all();
          // Gunakan Leave::all() alih-alih Leave::get()

          $user = User::where('role', '!=', 1)->pluck('id')->toArray();


          $tepat = Attendance::whereRaw("TIME(time) < '08:00:00'")
                              ->whereIn('enhancer', $user)
                              ->whereDate('time', Carbon::today())
                              ->get();
          
          $telat = Attendance::whereRaw("TIME(time) > '08:00:00'")
                              ->whereIn('enhancer', $user)
                              ->whereDate('time', Carbon::today())
                              ->get();
          

        // Menampilkan view dengan data pegawai
        return view('pages.admin.dashboard', compact('data', 'cuti','tepat','telat'));
    }

    public function cuti()
    {
        $data = User::with('role', 'schedule')->get();
        $cuti = Leave::all();  // Gunakan Leave::all() alih-alih Leave::get()

        // Menampilkan view dengan data pegawai
        return view('pages.admin.leave.kelolacuti', compact('data', 'cuti'));
    }

    public function cetakcuti()
    {
        $data = User::with('role', 'schedule')->get();
        $cuti = Leave::all();  // Gunakan Leave::all() alih-alih Leave::get()

        // Menampilkan view dengan data pegawai
        return view('pages.admin.leave.printkelolacuti', compact('data', 'cuti'));
    }

    public function cetaksatuancuti()
    {
        $data = User::with('role', 'schedule')->get();
        $cuti = Leave::all();  // Gunakan Leave::all() alih-alih Leave::get()

        // Menampilkan view dengan data pegawai
        return view('pages.admin.leave.printsatuancuti', compact('data', 'cuti'));
    }

    public function persetujuancuti()
    {
        return view('pages.admin.leave.pengajuancuti');
    }


    public function editcuti()
    {
        return view('pages.admin.leave.editcuti');
    }
}
