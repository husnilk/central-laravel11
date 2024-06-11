<?php

namespace Database\Seeders;

use App\Models\ClassCourse;
use App\Models\ClassLecturer;
use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Lecturer;
use App\Models\Period;
use App\Models\Student;
use Illuminate\Database\Seeder;

class PmpCurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturer_ids = Lecturer::all()->pluck('id', 'id')->toArray();
        $student1_ids = Student::where('year', 2021)
            ->whereRaw('nim % 2 == 1')
            ->get()
            ->pluck('id', 'id')
            ->toArray();
        
        $student2_ids = Student::where('year', 2021)
            ->whereRaw('nim % 2 == 0')
            ->get()
            ->pluck('id', 'id')
            ->toArray();
        $period = Period::create([
            'year' => 2023,
            'semester' => 2,
            'active' => 1
        ]);
        $curriculum = Curriculum::factory()
            ->hasPlos(7)
            ->create();

        $courses = Course::factory()
            ->count(5)
            ->hasPlans(1)
            ->create([
                'curriculum_id' => $curriculum->id,
            ]);

        foreach($courses as $course){
            $plan_details = $course->factory()
                ->count(16)
                ->create();
            $classes = ClassCourse::factory()
                ->count(2)
                ->create([
                    'course_id' => $course->id,
                    'period_id' => $period->id,
                    'course_plan_id' => $course->plans[0]->id
                ]);
            $id01 = array_rand($lecturer_ids);
            $id02 = array_rand($lecturer_ids);
            foreach($classes as $class) {
                ClassLecturer::create([
                    'class_id' => $class->id,
                    'lecturer_id' => $id01,
                    'position' => 1,
                    'grading' => 1
                ]);
                ClassLecturer::create([
                    'class_id' => $class->id,
                    'lecturer_id' => $id02,
                    'position' => 1,
                    'grading' => 1
                ]);
                foreach($student1_ids as $student1_id){

                }

            }
        }
    }
}
