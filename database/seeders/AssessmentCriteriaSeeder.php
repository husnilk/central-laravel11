<?php

namespace Database\Seeders;

use App\Models\AssessmentCriteria;
use Illuminate\Database\Seeder;

class AssessmentCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssessmentCriteria::factory()->count(5)->create();
    }
}
