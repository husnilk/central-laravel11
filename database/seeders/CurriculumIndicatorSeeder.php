<?php

namespace Database\Seeders;

use App\Models\CurriculumIndicator;
use Illuminate\Database\Seeder;

class CurriculumIndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurriculumIndicator::factory()->count(5)->create();
    }
}
