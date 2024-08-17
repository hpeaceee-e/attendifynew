<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\ScheduleController;
use Illuminate\Support\Facades\Route;

// Routes for authentication
Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes group with middleware and prefix
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('pages.admin.dashboard');

    // Manage Employees
    Route::prefix('kelolapegawai')->group(function () {
        Route::get('/', [EmployeController::class, 'index'])->name('kelolapegawai');
        Route::get('/tambahpegawai', [EmployeController::class, 'create'])->name('tambahpegawai');
        Route::post('/tambahpegawai/store', [EmployeController::class, 'store'])->name('tambahpegawaistore');
        Route::get('/{id}', [EmployeController::class, 'show'])->name('pegawaidetail');
        Route::post('/edit/{id}', [EmployeController::class, 'update'])->name('editpegawai');
        Route::get('/editpegawai', [AdminController::class, 'editpegawai']);
        Route::get('/cetakpegawai', [AdminController::class, 'cetakpegawai']);
    });

    // Manage Attendance
    Route::prefix('kelolakehadiranpegawai')->group(function () {
        Route::get('/', [AttendanceController::class, 'kehadiran'])->name('kelolakehadiranpegawai');
        Route::get('/cetakkehadiranpegawai', [AttendanceController::class, 'cetakkehadiran']);
    });

    // Manage Schedules
    Route::prefix('kelolajadwalpegawai')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('kelolajadwal');
        Route::get('/tambahjadwal', [ScheduleController::class, 'create'])->name('tambahjadwal');
        Route::post('/tambahjadwal/store', [ScheduleController::class, 'store'])->name('tambahjadwalstore');
    });

    // Manage Leave
    Route::get('/kelolacuti', [AdminController::class, 'cuti'])->name('kelolacuti');
});
