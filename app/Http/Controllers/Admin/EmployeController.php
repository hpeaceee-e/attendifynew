<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeController extends Controller
{
    public function index()
    {
        // Mengambil data pegawai dari database
        $data = User::with('role', 'schedule')->get();

        // Menampilkan view dengan data pegawai
        return view('pages.admin.managepegawai.kelolapegawai', compact('data'));
    }

    public function show($id)
    {
        // Mengambil data pegawai berdasarkan ID dengan relasi role dan schedule
        $data = User::with('role', 'schedule')->find($id);

        // Periksa apakah data ditemukan
        if (!$data) {
            return redirect()->route('admin.kelolapegawai')->with('error', 'Pegawai tidak ditemukan');
        }

        // Menampilkan view dengan data pegawai
        return view('pages.admin.managepegawai.detailkelolapegawai', compact('data'));
    }


    public function create()
    {
        // Mengambil data roles untuk ditampilkan di dropdown
        $roles = Role::all();
        $schedules = Schedule::all();

        // Menghitung ID pegawai berikutnya
        $nextUserId = User::max('id');

        // Menampilkan view form tambah pegawai
        return view('pages.admin.managepegawai.tambahpegawai', compact('roles', 'schedules', 'nextUserId'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:80',
            'role' => 'required|integer|exists:roles,id',
            'password' => 'required|string|min:8',
            'status' => 'required|in:0,1',
            'avatar' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'schedule' => 'required|integer|exists:schedules,id',
        ]);

        // Simpan file avatar
        $avatarPath = $request->file('avatar')->store('avatars', 'public');

        // Generate username
        $username = $request->input('role') == 1 ? 'admin' : str_pad(User::where('role', '!=', 1)->max('id'), 5, '0', STR_PAD_LEFT);

        // Simpan data pegawai baru ke database
        $user = User::create([
            'username' => $username,
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
            'status' => $request->input('status'),
            'avatar' => $avatarPath,
            'schedule_id' => $request->input('schedule'),
        ]);

        // Redirect kembali ke halaman kelola pegawai dengan pesan sukses
        return redirect()->route('admin.kelolapegawai')->with('success', 'Pegawai berhasil ditambahkan.', compact('user'));
    }

    public function edit(Request $request, $id)
    {
        $data = User::with('role', 'schedule')->find($id);

        $roles = Role::all();

        $schedules = Schedule::all();

        $nextUserId = User::max('id');
        // Periksa apakah data ditemukan
        if (!$data) {
            return redirect()->route('admin.kelolapegawai')->with('error', 'Pegawai tidak ditemukan');
        }

        return view('pages.admin.managepegawai.editpegawai', compact('data', 'nextUserId', 'roles', 'schedules'));
    }

    public function cetakpegawai()
    {
        $data = User::with('role', 'schedule')->get();

        // Menampilkan view dengan data pegawai
        return view('pages.admin.managepegawai.printkelolapegawai', compact('data'));
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
