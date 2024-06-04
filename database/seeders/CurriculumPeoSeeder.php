<?php

namespace Database\Seeders;

use App\Models\CurriculumPeo;
use Illuminate\Database\Seeder;

class CurriculumPeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CurriculumPeo::factory()->count(5)->create();
    }
}
