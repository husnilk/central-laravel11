<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Department::factory()->count(5)->create();
        Faculty::factory()
            ->count(1)
            ->hasDepartments(3)
            ->create();
    }
}
