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

        // Menghitung jumlah user yang ada untuk menentukan username berikutnya
        $nextUsername = str_pad(User::count(), 5, '0', STR_PAD_LEFT);

        // Menampilkan view form tambah pegawai dengan username yang sudah di-generate
        return view('pages.admin.managepegawai.tambahpegawai', compact('roles', 'schedules', 'nextUsername'));
    }




    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'username' => 'nullable|string|max:5|unique:users,username',
            'name' => 'nullable|string|max:80',
            'role' => 'nullable|integer|exists:roles,id',
            'email' => 'nullable|string|email|max:80|unique:users,email',
            'password' => 'nullable|string|min:8',
        ]);
        // Hitung jumlah user yang ada untuk menentukan username
        $count = User::count();

        // Buat username baru dengan format 00001, 00002, dst.
        $validatedData['username'] = str_pad($count, 5, '0', STR_PAD_LEFT);
        // Create a new user instance
        $user = new User($validatedData);

        // Hash the password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the user
        $user->save();

        // Redirect with a success message
        return redirect()->route('admin.kelolapegawai')->with('success', 'Pegawai berhasil ditambahkan.');
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
