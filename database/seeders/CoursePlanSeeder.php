<?php

namespace Database\Seeders;

use App\Models\CoursePlan;
use Illuminate\Database\Seeder;

class CoursePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlan::factory()->count(5)->create();
    }
}
