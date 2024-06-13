<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassCourse;
use App\Models\ClassProblem;
use App\Models\CourseEnrollment;
use App\Models\CourseEnrollmentDetail;
use App\Models\Period;
use Illuminate\Http\Request;

class MyCourseProblemController extends Controller
{
    public function store(Request $request, $course_id)
    {
        $user = auth()->user();
        $period = Period::getActive()->first();

        $enrollment = CourseEnrollment::where('student_id', $user->id)
            ->where('period_id', $period->id)
            ->first();
        //        $class_course = ClassCourse::find($course_id);
        //        $enrollment_detail = CourseEnrollmentDetail::where('class_id', $course_id)
        //            ->where('course_enrollment_id', $enrollment->id)
        //            ->first();
        $enrollment_detail = CourseEnrollmentDetail::find($course_id);

        $class_problem = ClassProblem::create([
            'class_course_id' => $enrollment_detail->class_id,
            'course_enrollment_detail_id' => $enrollment_detail->id,
            'problem' => $request->problem,
            'solution' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Problem saved successfully',
            'problem' => $class_problem,
        ]);
    }
}
