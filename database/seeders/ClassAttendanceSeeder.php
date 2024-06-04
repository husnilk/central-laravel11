<?php

namespace Database\Seeders;

use App\Models\ClassAttendance;
use Illuminate\Database\Seeder;

class ClassAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassAttendance::factory()->count(5)->create();
    }
}
