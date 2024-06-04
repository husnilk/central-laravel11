<?php

namespace Database\Seeders;

use App\Models\ThesisDefense;
use Illuminate\Database\Seeder;

class ThesisDefenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisDefense::factory()->count(5)->create();
    }
}
