<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Leave::create(
            [
                'enhancer' => 1, // Ganti dengan ID user yang valid
                'date' => '2024-08-15',
                'status' => 1,
                'reason' => 'Harus Melongok Ke Ruma Sakit dikarenakan teman saya sakit',
            ]
        );
    }
}
