<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassAttendance;
use App\Models\ClassMeeting;
use App\Models\CourseEnrollmentDetail;

class MyCourseMeetingController extends Controller
{
    public function show($course_id, $meeting_id)
    {
        $user = auth()->user();
        $detail = CourseEnrollmentDetail::find($course_id);
        $meeting = ClassMeeting::find($meeting_id);
        $attendance = ClassAttendance::where('course_enrollment_detail_id', $detail->id)
            ->where('class_meeting_id', $meeting_id)
            ->first();

        $course_plan = $detail->class->course->plans[0];

        return response()->json([
            'student_name' => $user->student->name,
            'student_nim' => $user->student->nim,
            'course_name' => $detail->class->course->name,
            'course_credit' => $detail->class->course->credit,
            'course_semester' => $detail->class->course->semester,
            'class_name' => $detail->class->name,
            'meet_no' => optional($meeting)->meet_no,
            'start_at' => optional($meeting)->meeting_start_at,
            'finish_at' => optional($meeting)->meeting_end_at,
            'material' => optional($meeting)->detail->material,
            'material_real' => optional($meeting)->material_real,
            'attendance' => optional($attendance)->status,
        ]);
    }
}
