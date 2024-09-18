<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserControllers1;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\ImportexcelController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\ScheduleController as ControllersScheduleController;
use App\Http\Middleware\AutoLogout;
use Illuminate\Console\Scheduling\Schedule;
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
            Route::delete('/hapus/{id}', [EmployeController::class, 'destroy'])->name('deletepegawai');
            Route::get('/cetakpegawai', [EmployeController::class, 'cetakpegawai'])->name('print-kelolapegawai');
            Route::get('restorepegawai/{id}', [AdminController::class, 'restore'])->name('restorepegawai');
            Route::get('trashedpegawai', [AdminController::class, 'trashed'])->name('trashedpegawai');
            Route::post('/input-pegawai', [EmployeController::class, 'input'])->name('input-excel');
        });

        // Manage Attendance
        Route::prefix('attendance.kelolakehadiranpegawai')->group(function () {
            Route::get('/', [AttendanceController::class, 'kehadiran'])->name('kelolakehadiranpegawai');
            Route::get('/cetakkehadiranpegawai', [AttendanceController::class, 'cetakkehadiran'])->name('print-kelolakehadiranpegawai');
            Route::get('/cetakkehadiranpegawai{id}', [AttendanceController::class, 'cetakkehadiranorang'])->name('print-kelolakehadiranpegawai-orang');
            Route::get('/print-selection', [AttendanceController::class, 'printSelection'])->name('print-selection');
            Route::post('/print-selected', [AttendanceController::class, 'printSelected'])->name('print-selected');
        });

        // Manage Schedules
        Route::prefix('schedule.kelolajadwalpegawai')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('kelolajadwal');
            Route::get('/tambahjadwal', [ScheduleController::class, 'create'])->name('tambahjadwal');
            Route::post('/tambahjadwal/store', [ScheduleController::class, 'store'])->name('tambahjadwalstore');
            Route::get('/editjadwal/{id}', [ScheduleController::class, 'edit'])->name('editjadwal');
            Route::post('/updatejadwal/{id}', [ScheduleController::class, 'update'])->name('updatejadwal');
            Route::get('/printjadwal', [ScheduleController::class, 'print'])->name('print-jadwal');
        });

        Route::prefix('leave.kelolacuti')->group(function () {
            Route::get('/', [LeaveController::class, 'index'])->name('kelolacuti');
            Route::get('/persetujuancuti', [LeaveController::class, 'create'])->name('persetujuancuti');
            Route::post('/update/{id}', [LeaveController::class, 'update'])->name('update-cuti');
            Route::get('/printkelolacuti', [LeaveController::class, 'cetakcuti'])->name('print-kelolacuti');
            Route::get('/printsatuancuti', [LeaveController::class, 'cetaksatuancuti'])->name('print-satuancuti');
        });
    });


    Route::get('/import', [ImportexcelController::class, 'index']);
    Route::post('/import/excel', [ImportexcelController::class, 'post'])->name('post-excel');

    Route::group(['prefix' => 'pegawai', 'middleware' => ['pegawai'], 'as' => 'pegawai.'], function () {

        Route::get('/dashboard', [UserControllers1::class, 'index'])->name('pages.pegawai.dashboard');

        Route::prefix('attendance')->group(function () {
            Route::get('/', [AttendanceController::class, 'index'])->name('attendance');
            Route::get('/tambahabsensi', [AttendanceController::class, 'create'])->name('tambah-attendance');
            Route::post('/tambahabsensi/store', [AttendanceController::class, 'store'])->name('store-attendance');
            Route::get('/attendance/{id}/print', [AttendanceController::class, 'print'])->name('print-attendance');
        });

        Route::prefix('schedule')->group(function () {
            Route::get('/', [ControllersScheduleController::class, 'index'])->name('schedule');
        });

        Route::prefix('leaves')->group(function () {
            Route::get('/', [LeavesController::class, 'index'])->name('leaves');
            Route::get('/create', [LeavesController::class, 'create'])->name('create-cuti');
            Route::post('/store', [LeavesController::class, 'store'])->name('store-cuti');
            Route::get('/leaves/{id}/edit', [LeavesController::class, 'edit'])->name('edit-cuti');
            Route::put('/update/{id}', [LeavesController::class, 'update'])->name('update-cuti');

            Route::get('/print', [LeavesController::class, 'print'])->name('print-cuti');
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
