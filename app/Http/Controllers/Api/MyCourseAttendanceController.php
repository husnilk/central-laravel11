<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassAttendance;
use Illuminate\Http\Request;

class MyCourseAttendanceController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $attendance = new ClassAttendance();
        $attendance->course_enrollment_detail_id = $request->course_id;
        $attendance->class_meeting_id = $request->class_meeting_id;
        $attendance->status = 1;
        $attendance->meet_no = 0;
        $attendance->attendance_status = 1;
        $attendance->need_attention = 0;
        $attendance->information = '';
        $attendance->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance recorded successfully',
            'attendance' => $attendance,
        ]);
    }
}
