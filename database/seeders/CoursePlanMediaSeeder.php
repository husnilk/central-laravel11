<?php

namespace Database\Seeders;

use App\Models\CoursePlanMedia;
use Illuminate\Database\Seeder;

class CoursePlanMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanMedia::factory()->count(5)->create();
    }
}
