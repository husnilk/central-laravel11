<?php

namespace Database\Seeders;

use App\Models\ClassCourse;
use Illuminate\Database\Seeder;

class ClassCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassCourse::factory()->count(5)->create();
    }
}
