<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function kehadiran()
    {
        $attendances = Attendance::get();
        return view('pages.admin.kelolakehadiranpegawai', compact('attendances'));
    }
}
