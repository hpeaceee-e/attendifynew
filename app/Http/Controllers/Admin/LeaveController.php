<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $cuti = Leave::all();  // Gunakan Leave::all() alih-alih Leave::get()

        // Menampilkan view dengan data pegawai
        return view('pages.admin.leave.kelolacuti', compact('cuti'));
    }

    public function show() {}

    public function create()
    {
        return view('pages.admin.leave.pengajuancuti');
    }

    public function store()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
