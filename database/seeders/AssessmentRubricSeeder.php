<?php

namespace Database\Seeders;

use App\Models\AssessmentRubric;
use Illuminate\Database\Seeder;

class AssessmentRubricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssessmentRubric::factory()->count(5)->create();
    }
}
