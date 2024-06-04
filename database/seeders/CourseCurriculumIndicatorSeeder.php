<?php

namespace Database\Seeders;

use App\Models\CourseCurriculumIndicator;
use Illuminate\Database\Seeder;

class CourseCurriculumIndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseCurriculumIndicator::factory()->count(5)->create();
    }
}
