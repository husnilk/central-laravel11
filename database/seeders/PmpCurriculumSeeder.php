<?php

namespace Database\Seeders;

use App\Models\ClassCourse;
use App\Models\ClassLecturer;
use App\Models\ClassMeeting;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseEnrollmentDetail;
use App\Models\CoursePlanDetail;
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
        $period = Period::create([
            'year' => 2023,
            'semester' => 2,
            'active' => 1,
        ]);
        $lecturer_ids = Lecturer::all()->pluck('id', 'id')->toArray();
        $student1_ids = Student::where('year', 2021)
            ->whereRaw('nim % 2 = 1')
            ->get()
            ->pluck('id', 'id')
            ->toArray();

        $krs1 = collect();
        foreach ($student1_ids as $student_id) {
            $krs = CourseEnrollment::create([
                'student_id' => $student_id,
                'period_id' => $period->id,
                'status' => 1,
            ]);
            $krs1->push($krs);
        }

        $student2_ids = Student::where('year', 2021)
            ->whereRaw('nim % 2 = 0')
            ->get()
            ->pluck('id', 'id')
            ->toArray();
        $krs2 = collect();
        foreach ($student2_ids as $student_id) {
            $krs = CourseEnrollment::create([
                'student_id' => $student_id,
                'period_id' => $period->id,
                'status' => 1,
            ]);
            $krs2->push($krs);
        }

        $curriculum = Curriculum::factory()
            ->hasPlos(7)
            ->create();

        $courses = Course::factory()
            ->count(3)
            ->hasPlans(1)
            ->create([
                'curriculum_id' => $curriculum->id,
            ]);

        foreach ($courses as $course) {
            //            $plan_details = $course->plans[0]
            //                ->factory()
            //                ->hasDetails(16)
            //                ->create();
            $id01 = array_rand($lecturer_ids);
            $id02 = array_rand($lecturer_ids);

            $class = ClassCourse::factory()
                ->create([
                    'course_id' => $course->id,
                    'period_id' => $period->id,
                    'course_plan_id' => $course->plans[0]->id,
                    'name' => 'A',
                ]);

            ClassLecturer::create([
                'class_id' => $class->id,
                'lecturer_id' => $id01,
                'position' => 1,
                'grading' => 1,
            ]);
            ClassLecturer::create([
                'class_id' => $class->id,
                'lecturer_id' => $id02,
                'position' => 1,
                'grading' => 1,
            ]);
            foreach ($krs1 as $krs) {
                CourseEnrollmentDetail::create([
                    'course_enrollment_id' => $krs->id,
                    'class_id' => $class->id,
                ]);
            }

            $course_plan = $course->plans[0];
            $details = CoursePlanDetail::factory()
                ->count(16)
                ->create([
                    'course_plan_id' => $course_plan->id,
                ]);

            $no = 1;
            foreach ($details as $detail) {
                ClassMeeting::factory()->create([
                    'meet_no' => $no,
                    'class_id' => $class->id,
                    'course_plan_detail_id' => $detail->id,
                    'class_lecturer_id' => $id01,
                ]);
                $no++;
            }

            $class = ClassCourse::factory()
                ->create([
                    'course_id' => $course->id,
                    'period_id' => $period->id,
                    'course_plan_id' => $course->plans[0]->id,
                    'name' => 'B',
                ]);

            ClassLecturer::create([
                'class_id' => $class->id,
                'lecturer_id' => $id01,
                'position' => 1,
                'grading' => 1,
            ]);
            ClassLecturer::create([
                'class_id' => $class->id,
                'lecturer_id' => $id02,
                'position' => 1,
                'grading' => 1,
            ]);
            foreach ($krs2 as $krs) {
                CourseEnrollmentDetail::create([
                    'course_enrollment_id' => $krs->id,
                    'class_id' => $class->id,
                ]);
            }
            $no = 1;
            foreach ($details as $detail) {
                ClassMeeting::factory()->create([
                    'meet_no' => $no,
                    'class_id' => $class->id,
                    'course_plan_detail_id' => $detail->id,
                    'class_lecturer_id' => $id01,
                ]);
                $no++;
            }
        }
    }
}
