<?php

namespace Database\Seeders;

use App\Models\CoursePlanAssessment;
use Illuminate\Database\Seeder;

class CoursePlanAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanAssessment::factory()->count(5)->create();
    }
}
