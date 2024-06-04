<?php

namespace Database\Seeders;

use App\Models\CurriculumPeoPlo;
use Illuminate\Database\Seeder;

class CurriculumPeoPloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurriculumPeoPlo::factory()->count(5)->create();
    }
}
