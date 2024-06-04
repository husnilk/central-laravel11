<?php

namespace Database\Seeders;

use App\Models\CoursePlanDetail;
use Illuminate\Database\Seeder;

class CoursePlanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanDetail::factory()->count(5)->create();
    }
}
