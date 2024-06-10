<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Database\Seeder;

class PmpCurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curriculum = Curriculum::factory()
            ->hasPlos(7)
            ->create();

        $course = Course::factory()
            ->count(5)
            ->hasPlans(1)
            ->create([
                'curriculum_id' => $curriculum->id,
            ]);
    }
}
