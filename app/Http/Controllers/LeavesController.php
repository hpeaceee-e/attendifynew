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
        // Get the currently authenticated user's ID
        $id_user = Auth::user()->id;

        // Fetch leaves associated with the currently authenticated user
        $leaves = Leave::where('enhancer', $id_user)->with('user')->get();

        // Fetch the name of the currently authenticated user
        $name = User::where('id', $id_user)->value('name');

        // Pass the data to the view
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
            'date' => 'required|date_format:d M Y',
            'end_date' => 'required|date_format:d M Y|after_or_equal:date',
        ]);

        // Convert date formats from 'dd M yyyy' to 'Y-m-d'
        $date = \DateTime::createFromFormat('d M Y', $validatedData['date'])->format('Y-m-d');
        $end_date = \DateTime::createFromFormat('d M Y', $validatedData['end_date'])->format('Y-m-d');


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

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'reason_verification' => 'required|string|max:255',
            'about' => 'required|string|max:255',
            'date' => 'required|date_format:d-M-Y',
            'end_date' => 'required|date_format:d-M-Y|after_or_equal:date',
        ]);

        // Temukan record cuti berdasarkan ID
        $leave = Leave::findOrFail($id);

        // Konversi tanggal dari d-m-Y ke Y-m-d sebelum disimpan
        $leave->date = \Carbon\Carbon::createFromFormat('d M Y', $request->input('date'))->format('Y M d');
        $leave->end_date = \Carbon\Carbon::createFromFormat('d M Y', $request->input('end_date'))->format('Y M d');

        // Update data lainnya
        $leave->reason_verification = $request->input('reason_verification');
        $leave->about = $request->input('about');
        $leave->save();

        // Redirect dengan pesan sukses
        return redirect()->route('pegawai.leaves')->with('success', 'Cuti berhasil diperbarui');
    }


    public function print()
    {
        $id_user = Auth::user()->id;
        $leaves = Leave::where('enhancer', $id_user)->with('user')->get();
        $name = User::where('id', $id_user)->value('name');
        return view('pages.pegawai.leaves.print', compact('leaves'));
    }
}
