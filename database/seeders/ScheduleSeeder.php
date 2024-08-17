<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create(
            [
                'clock_in' => '2024-08-15 08:00:00',
                'clock_out' => '2024-08-15 17:00:00',
                'break' => '2024-08-15 12:00:00',
            ]
        );
    }
}
