<?php

namespace Database\Seeders;

use App\Models\ClassProblem;
use Illuminate\Database\Seeder;

class ClassProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassProblem::factory()->count(5)->create();
    }
}
