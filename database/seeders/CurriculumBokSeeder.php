<?php

namespace Database\Seeders;

use App\Models\CurriculumBok;
use Illuminate\Database\Seeder;

class CurriculumBokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurriculumBok::factory()->count(5)->create();
    }
}
