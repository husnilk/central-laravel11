<?php

namespace Database\Seeders;

use App\Models\ClassCourse;
use App\Models\ClassLecturer;
use App\Models\ClassMeeting;
use App\Models\Course;
use App\Models\CourseCurriculumIndicator;
use App\Models\CourseEnrollment;
use App\Models\CourseEnrollmentDetail;
use App\Models\CoursePlanDetail;
use App\Models\CoursePlanLo;
use App\Models\Curriculum;
use App\Models\CurriculumIndicator;
use App\Models\CurriculumPlo;
use App\Models\Lecturer;
use App\Models\Period;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PmpCurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $period = Period::getActive()->first();
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
                'final_term_passcode' => 'XAFYAZ',
                'mid_term_passcode' => 'XADAYD',
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
        $los_ids = CurriculumPlo::all()->pluck('id', 'id')->toArray();
        foreach ($los_ids as $los_id) {
            CurriculumIndicator::factory()
                ->create([
                    'curriculum_plo_id' => $los_id,
                ]);
        }
        $curlos_ids = CurriculumIndicator::all()->pluck('id', 'id')->toArray();

        foreach ($courses as $course) {
            $course_plan = $course->plans[0];
            foreach ($curlos_ids as $curlos_id) {
                CourseCurriculumIndicator::create([
                    'curriculum_indicator_id' => $curlos_id,
                    'course_id' => $course->id,
                ]);
            }
            $indicators = CurriculumIndicator::all()->pluck('id', 'id')->toArray();
            $course_plan_lo = CoursePlanLo::factory()->create([
                'course_plan_id' => $course_plan->id,
                'curriculum_indicator_id' => array_rand($indicators),
            ]);
            $id01 = array_rand($lecturer_ids);
            $id02 = array_rand($lecturer_ids);

            $class = ClassCourse::create([
                'course_id' => $course->id,
                'period_id' => $period->id,
                'course_plan_id' => $course->plans[0]->id,
                'name' => 'A',
            ]);

            $class_lecturer01 = ClassLecturer::create([
                'class_id' => $class->id,
                'lecturer_id' => $id01,
                'position' => 1,
                'grading' => 1,
            ]);
            $class_lecturer02 = ClassLecturer::create([
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

            $details = CoursePlanDetail::factory()
                ->count(16)
                ->create([
                    'week_no' => new Sequence(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16),
                    'course_plan_lo_id' => $course_plan_lo->id,
                    'course_plan_id' => $course_plan->id,
                ]);

            $no = 1;
            foreach ($details as $detail) {
                ClassMeeting::create([
                    'meet_no' => $no,
                    'class_id' => $class->id,
                    'course_plan_detail_id' => $detail->id,
                    'class_lecturer_id' => $class_lecturer01->id,
                    'material_real' => $detail->material,
                    'assessment_real' => '-',
                    'meeting_start_at' => Carbon::now(),
                    'meeting_end_at' => Carbon::now(),
                    'method' => 1,
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

            $class_lecturer01 = ClassLecturer::create([
                'class_id' => $class->id,
                'lecturer_id' => $id01,
                'position' => 1,
                'grading' => 1,
            ]);
            $class_lecturer02 = ClassLecturer::create([
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
                ClassMeeting::create([
                    'meet_no' => $no,
                    'class_id' => $class->id,
                    'course_plan_detail_id' => $detail->id,
                    'class_lecturer_id' => $class_lecturer01->id,
                    'material_real' => $detail->material,
                    'assessment_real' => '-',
                    'method' => 1,
                ]);
                $no++;
            }
        }
    }
}
