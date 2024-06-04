<?php

namespace Database\Seeders;

use App\Models\CoursePlanReference;
use Illuminate\Database\Seeder;

class CoursePlanReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanReference::factory()->count(5)->create();
    }
}
