<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;

class LeavesController extends Controller
{
    public function index()
    {
        // Mengambil semua data leaves beserta nama pengguna terkait
        $leaves = Leave::with('user')->get();
        $id_user = Auth::user()->id;
        $data = User::where('id', $id_user)->get();
        $name = User::where('id', $id_user)->value('name');

        return view('pages.pegawai.leaves.index', compact('leaves', 'name'));
    }


    public function create()
    {
        return view('pages.pegawai.leaves.create');
    }

    public function store(Request $request)
    {
        // Validasi data input dari form pengajuan cuti
        $validatedData = $request->validate([
            'reason_verification' => 'nullable|string|max:255',
            'about' => 'required|string',
            'date' => 'required|date_format:m/d/Y',
            'end_date' => 'required|date_format:m/d/Y|after_or_equal:date',
        ]);

        // Convert date formats from m/d/Y to Y-m-d
        $date = \DateTime::createFromFormat('m/d/Y', $validatedData['date'])->format('Y-m-d');
        $end_date = \DateTime::createFromFormat('m/d/Y', $validatedData['end_date'])->format('Y-m-d');

        // Mengambil ID pengguna yang sedang login
        $id_user = Auth::user()->id;

        // Membuat instance baru untuk pengajuan cuti
        $leave = new Leave();
        $leave->enhancer = $id_user; // Menghubungkan pengajuan cuti dengan pengguna
        $leave->reason_verification = $validatedData['reason_verification'];
        $leave->about = $validatedData['about'];
        $leave->date = $date; // Menggunakan field 'date'
        $leave->end_date = $end_date;
        $leave->status = null; // Status awal sebagai "Menunggu" (belum ada konfirmasi)

        // Menyimpan pengajuan cuti ke database
        $leave->save();

        // Redirect dengan pesan sukses
        return redirect()->route('pegawai.leaves')->with('success', 'Pengajuan cuti berhasil ditambahkan dan sedang menunggu konfirmasi.');
    }

    public function edit($id)
    {
        $leave = Leave::with('user')->findOrFail($id);
        return view('pages.pegawai.leaves.edit', compact('leave'));
    }



    public function update()
    {
        return view('pages.pegawai.leaves.edit');
    }

    public function print()
    {
        return view('pages.pegawai.leaves.print');
    }
}
