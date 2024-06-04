<?php

namespace Database\Seeders;

use App\Models\CoursePlanLo;
use Illuminate\Database\Seeder;

class CoursePlanLoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanLo::factory()->count(5)->create();
    }
}
