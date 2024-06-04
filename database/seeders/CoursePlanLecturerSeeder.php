<?php

namespace Database\Seeders;

use App\Models\CoursePlanLecturer;
use Illuminate\Database\Seeder;

class CoursePlanLecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanLecturer::factory()->count(5)->create();
    }
}
