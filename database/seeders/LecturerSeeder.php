<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Lecturer::factory()->count(5)->create();
        Department::factory()
            ->count(1)
            ->hasLecturers(5)
            ->create();
    }
}
