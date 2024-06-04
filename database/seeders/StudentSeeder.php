<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()
            ->count(1)
            ->hasStudents(25)
            ->create();
    }
}
