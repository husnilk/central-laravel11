<?php

namespace Database\Seeders;

use App\Models\ThesisRubric;
use Illuminate\Database\Seeder;

class ThesisRubricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisRubric::factory()->count(5)->create();
    }
}
