<?php

namespace Database\Seeders;

use App\Models\CurriculumPlo;
use Illuminate\Database\Seeder;

class CurriculumPloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurriculumPlo::factory()->count(5)->create();
    }
}
