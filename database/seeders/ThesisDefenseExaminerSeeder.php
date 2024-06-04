<?php

namespace Database\Seeders;

use App\Models\ThesisDefenseExaminer;
use Illuminate\Database\Seeder;

class ThesisDefenseExaminerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisDefenseExaminer::factory()->count(5)->create();
    }
}
