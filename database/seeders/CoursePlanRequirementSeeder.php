<?php

namespace Database\Seeders;

use App\Models\CoursePlanRequirement;
use Illuminate\Database\Seeder;

class CoursePlanRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanRequirement::factory()->count(5)->create();
    }
}
