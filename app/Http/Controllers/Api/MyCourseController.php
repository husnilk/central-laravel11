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
        $period = Period::getActive();
        $courseEnrolls = CourseEnrollment::with('details.classCourse.course')
            ->where('student_id', $user->id)
            ->where('period_id', $period->id)
            ->get();

        $courses = collect();
        foreach ($courseEnrolls as $enrollment) {
            $courses->add([

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

        return response()->json($enrollment);
    }
}
