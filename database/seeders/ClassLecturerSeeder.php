<?php

namespace Database\Seeders;

use App\Models\ClassLecturer;
use Illuminate\Database\Seeder;

class ClassLecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassLecturer::factory()->count(5)->create();
    }
}
