<?php

namespace Database\Seeders;

use App\Models\CurriculumBokDetail;
use Illuminate\Database\Seeder;

class CurriculumBokDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurriculumBokDetail::factory()->count(5)->create();
    }
}
