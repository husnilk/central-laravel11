<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\CourseEnrollmentDetail;
use App\Models\Period;

class MyCourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $period = Period::where('active', 1)->first();
        $enrollment = CourseEnrollment::with('details.class.course')
            ->where('student_id', $user->id)
            ->where('period_id', $period->id)
            ->first();

        $courses = collect();
        foreach ($enrollment->details as $enrollment) {
            $courses->push([
                'id' => $enrollment->id,
                'course_name' => $enrollment->class->course->name,
                'course_credit' => $enrollment->class->course->credit,
                'course_semester' => $enrollment->class->course->semester,
                'class_name' => $enrollment->class->name,
                'lecturers' => $enrollment->class->lectures,
                'status' => 1,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil didapatkan',
            'count' => $courses->count(),
            'courses' => $courses,
        ]);
    }

    public function show($id)
    {
        $user = auth()->user();
        $enrollment = CourseEnrollmentDetail::find($id);

        return response()->json([
            'id' => $enrollment->id,
            'course_name' => $enrollment->class->course->name,
            'course_credit' => $enrollment->class->course->credit,
            'course_semester' => $enrollment->class->course->semester,
            'class_name' => $enrollment->class->name,
            'lecturers' => $enrollment->class->lectures,
            'status' => 1,
            'meetings' => $enrollment->class->meetings
        ]);
    }
}
