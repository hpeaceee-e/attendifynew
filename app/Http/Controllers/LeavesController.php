<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        // dd($request->all());
        // Validasi data input
        $validatedData = $request->validate([
            'enhancer' => 'required',
            'reason' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'leave_letter' => 'nullable',
            'date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:date',
        ]);

        // Inisialisasi objek Leave
        $leave = new Leave();

        // Konversi tanggal
        $leave->date = Carbon::createFromFormat('d M Y', $request->input('date'))->format('Y-m-d');
        $leave->end_date = Carbon::createFromFormat('d M Y', $request->input('end_date'))->format('Y-m-d');

        // Set data lain yang sudah tervalidasi
        $leave->enhancer = $validatedData['enhancer'];
        $leave->reason = $validatedData['reason'];
        $leave->category = $validatedData['category'];
        $leave->leave_letter = $validatedData['leave_letter'];
        $leave->subcategory = $validatedData['subcategory'];
        $leave->save();

        return redirect()->route('pegawai.leaves')->with('success', 'Pengajuan cuti berhasil ditambahkan dan sedang menunggu konfirmasi.');
    }

    public function edit($id)
    {
        $leave = Leave::with('user')->findOrFail($id);
        return view('pages.pegawai.leaves.edit', compact('leave'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi data input
        $request->validate([
            'reason' => 'required|string',
            'reason_verification' => 'required|string|max:255',
            'date' => 'required|date_format:d-M-Y',
            'end_date' => 'required|date_format:d-M-Y|after_or_equal:date',
            'leave_letter' => 'nullable|file|mimes:pdf,doc,docx', // Validasi file surat cuti (opsional)
        ]);

        // Temukan record cuti berdasarkan ID
        $leave = Leave::findOrFail($id);

        // Konversi tanggal dari d-M-Y ke Y-m-d sebelum disimpan
        $leave->date = \Carbon\Carbon::createFromFormat('d-M-Y', $request->input('date'))->format('Y-m-d');
        $leave->end_date = \Carbon\Carbon::createFromFormat('d-M-Y', $request->input('end_date'))->format('Y-m-d');

        // Update data lainnya
        $leave->reason = $request->input('reason');
        $leave->reason_verification = $request->input('reason_verification');

        // Proses upload file surat cuti jika ada
        if ($request->hasFile('leave_letter')) {
            $file = $request->file('leave_letter');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('storage/leave_letters'), $filename);
            $leave->leave_letter = $filename;
        }

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
