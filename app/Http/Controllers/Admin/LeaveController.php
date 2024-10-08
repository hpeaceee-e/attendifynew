<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('user')->get();
        $leaves_annual = Leave::with('user')->get();
        $leaves_etc = Leave::with('user')->get();
        $id_user = Auth::user()->id;
        $data = User::where('id', $id_user)->get();
        $name = User::where('id', $id_user)->value('name');

        // Menampilkan view dengan data pegawai
        return view('pages.admin.leave.kelolacuti', compact('leaves_annual', 'leaves', 'leaves_etc', 'name'));
    }

    public function show() {}

    public function create()
    {
        return view('pages.admin.leave.pengajuancuti');
    }

    public function store(Request $request)
    {
        // // Validasi data
        // $request->validate([
        //     'id' => 'required|exists:leaves,id',
        //     'status' => 'required|in:0,1',
        //     'reason' => 'nullable|string|max:255',
        // ]);

        // // Temukan record cuti
        // $leaves = Leave::findOrFail($request->id);

        // // Perbarui status cuti
        // $leaves->status = $request->status;
        // $leaves->reason = $request->status == '1' ? $request->reason : null; // Simpan alasan jika status 'Ditolak'
        // $leaves->save();

        // // Redirect kembali dengan pesan sukses
        // return redirect()->route('kelolacuti')->with('success', 'Status pengajuan cuti berhasil diperbarui.');
    }



    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi data
        $request->validate([
            'enhancer' => 'nullable',
            'id' => 'required|exists:leaves,id',
            // 'enhancer' => 'required|exists:users,id', // Pastikan enhancer ada di tabel users
            'status' => 'required|in:0,1',
            'reason' => 'nullable|string|max:255',
        ]);

        // Temukan record cuti
        $leave = Leave::findOrFail($id);

        // Perbarui status cuti
        $leave->status = $request->status;
        $leave->reason_verification = $request->status == '1' ? $request->reason : null; // Simpan alasan jika status 'Ditolak'
        // $leave->enhancer = $request->enhancer; // Update enhancer
        $leave->save();
        if ($request->status == 0) {
            $avail = User::where('id', $request->enhancer)->value('available');

            $daysleave = \Carbon\Carbon::parse($leave->date)->diffInDays($leave->end_date);
            $totalday = $avail - $daysleave;
            // dd($totalday);
            // Update the authenticated user’s available days
            $enhancer = User::where('id', $request->enhancer)->value('id');
            $user = User::findOrFail($enhancer);
            $user->available = $totalday;
            $user->save();
        }
        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.kelolacuti')->with('success', 'Status pengajuan cuti berhasil diperbarui.');
    }


    public function cetakcuti()
    {
        $leaves = Leave::with('user')->get();
        return view('pages.admin.leave.printkelolacuti', compact('leaves'));
    }

    public function cetaksatuancuti()
    {
        return view('pages.admin.leave.printsatuancuti');
    }

    public function filtercuti() {}


    public function destroy()
    {
        //
    }
}
