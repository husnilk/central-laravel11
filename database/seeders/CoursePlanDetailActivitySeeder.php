<?php

namespace Database\Seeders;

use App\Models\CoursePlanDetailActivity;
use Illuminate\Database\Seeder;

class CoursePlanDetailActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanDetailActivity::factory()->count(5)->create();
    }
}
