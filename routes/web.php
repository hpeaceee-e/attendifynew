<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserControllers1;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\ImportexcelController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeavesController;
use App\Http\Middleware\AutoLogout;
use Illuminate\Support\Facades\Route;

// Routes for authentication
Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//auto Logout
Route::middleware([AutoLogout::class])->group(function () {

    // Admin routes group with middleware and prefix
    Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('pages.admin.dashboard');

        // Manage Employees
        Route::prefix('managepegawai.kelolapegawai')->group(function () {
            Route::get('/', [EmployeController::class, 'index'])->name('kelolapegawai');
            Route::get('/tambahpegawai', [EmployeController::class, 'create'])->name('tambahpegawai');
            Route::post('/tambahpegawai/store', [EmployeController::class, 'store'])->name('tambahpegawaistore');
            Route::get('/pegawai{id}', [EmployeController::class, 'show'])->name('pegawaidetail');
            Route::get('/editpegawai/{id}', [EmployeController::class, 'edit'])->name('editpegawai');
            Route::post('/updatepegawai/{id}', [EmployeController::class, 'update'])->name('editpegawaiupdate');
            Route::get('/cetakpegawai', [EmployeController::class, 'cetakpegawai'])->name('print-kelolapegawai');
        });

        // Manage Attendance
        Route::prefix('attendance.kelolakehadiranpegawai')->group(function () {
            Route::get('/', [AttendanceController::class, 'kehadiran'])->name('kelolakehadiranpegawai');
            Route::get('/cetakkehadiranpegawai', [AttendanceController::class, 'cetakkehadiran'])->name('print-kelolakehadiranpegawai');
            Route::get('/cetakkehadiranpegawai{id}', [AttendanceController::class, 'cetakkehadiranorang'])->name('print-kelolakehadiranpegawai-orang');
        });

        // Manage Schedules
        Route::prefix('schedule.kelolajadwalpegawai')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('kelolajadwal');
            Route::get('/tambahjadwal', [ScheduleController::class, 'create'])->name('tambahjadwal');
            Route::post('/tambahjadwal/store', [ScheduleController::class, 'store'])->name('tambahjadwalstore');
            Route::get('/editjadwal/{id}', [ScheduleController::class, 'edit'])->name('editjadwal');
            Route::post('/updatejadwal/{id}', [ScheduleController::class, 'update'])->name('updatejadwal');
        });

        // Manage Leave
        Route::prefix('leave.kelolacuti')->group(function () {
            Route::get('/', [AdminController::class, 'cuti'])->name('kelolacuti');
            Route::get('/printkelolacuti', [AdminController::class, 'cetakcuti'])->name('print-kelolacuti');
            Route::get('/persetujuancuti', [AdminController::class, 'persetujuancuti'])->name('persetujuancuti');
            Route::get('/editcuti', [AdminController::class, 'editcuti'])->name('editcuti');
        });
    });


    Route::get('/import', [ImportexcelController::class, 'index']);
    Route::post('/import/excel', [ImportexcelController::class, 'post'])->name('post-excel');

    Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {

        Route::get('/dashboard', [UserControllers1::class, 'index'])->name('pages.pegawai.dashboard');

        Route::prefix('attendance')->group(function () {
            Route::get('/', [AttendanceController::class, 'index'])->name('attendance');
            Route::get('/tambahjadwal', [AttendanceController::class, 'create'])->name('tambah-attendance');
            Route::post('/tambahjadwal/store', [AttendanceController::class, 'store'])->name('store-attendance');
            Route::get('/attendance/{id}/print', [AttendanceController::class, 'print'])->name('print-attendance');
        });
        Route::prefix('leaves')->group(function () {
            Route::get('/', [LeavesController::class, 'index'])->name('leaves');
        });
        Route::prefix('izin')->group(function () {
            Route::get('/', [IzinController::class, 'index'])->name('izin');
        });
        Route::prefix('profil')->group(function () {
            Route::get('/akun', [UserControllers1::class, 'profilakun'])->name('profilakun');
            Route::get('/biodata', [UserControllers1::class, 'profilbiodata'])->name('profilbiodata');
            Route::put('/biodata/update/{id}', [UserControllers1::class, 'updates'])->name('update');
            Route::patch('/user/{id}/avatar', [UserControllers1::class, 'updateAvatar'])->name('updateAvatar');
            Route::get('/identitas', [UserControllers1::class, 'profilidentitas'])->name('profilidentitas');
        });
    });
});
