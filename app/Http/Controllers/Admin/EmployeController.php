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

    public function edit($id)
    {
        $item = User::findOrFail($id);
        $roles = Role::all();
        $schedules = Schedule::all();
        return view('pages.admin.managepegawai.editpegawai', compact('item', 'roles', 'schedules'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:80',
            'role' => 'required|integer|exists:roles,id',
            'email' => 'required|string|email|max:80|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|boolean',
            'schedule' => 'required|integer|exists:schedules,id',
        ]);

        // Find the user with their associated role and schedule
        $data = User::findOrFail($id);

        // Update user data except for password if it's empty
        $data->name = $validatedData['name'];
        $data->role = $validatedData['role'];
        $data->email = $validatedData['email'];
        $data->status = $validatedData['status'];
        $data->schedule = $validatedData['schedule'];

        // Update password only if provided
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }

        // Handle avatar upload if any
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data->avatar = $avatarPath;
        }

        // Save the updated user
        $data->save();

        // Redirect with a success message
        return redirect()->route('admin.kelolapegawai')->with('success', 'Pegawai berhasil diedit.');
    }



    public function destroy()
    {
        //
    }

    public function cetakpegawai()
    {
        $data = User::with('role', 'schedule')->get();

        // Menampilkan view dengan data pegawai
        return view('pages.admin.managepegawai.printkelolapegawai', compact('data'));
    }
}
