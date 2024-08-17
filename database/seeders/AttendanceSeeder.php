<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attendance::insert([
            [
                'enhancer' => 1, // Ganti dengan ID user yang valid
                'date' => now(),
                'time' =>  now(),
                'status' => 1,
                'coordinate' => '-6.917464, 107.619123',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            // Tambahkan entri lainnya di sini jika diperlukan
        ]);
    }
}
