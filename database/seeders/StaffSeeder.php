<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //        Staff::factory()->count(5)->create();
        Department::factory()
            ->count(1)
            ->hasStaff(5)
            ->create();
    }
}
