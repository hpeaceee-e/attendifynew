<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Update status menjadi aktif (0) saat pengguna berinteraksi
            if ($user->status == 1) {
                $user->status = 0;
                // $user = new User;
                $user->save();
            }

            // Jika pengguna sudah tidak aktif lebih dari X menit, ubah status menjadi tidak aktif (1)
            $lastActivity = session('last_activity');
            $inactivityLimit = 1 * 60; // 5 menit dalam detik

            if ($lastActivity && (time() - $lastActivity) > $inactivityLimit) {
                $user->status = 1;
                // $user = new User;
                $user->save();
            }

            // Update waktu aktivitas terakhir
            session(['last_activity' => time()]);
        }

        return $next($request);
    }
}
