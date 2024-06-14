<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassAttendance;
use App\Models\ClassMeeting;
use App\Models\CourseEnrollment;
use App\Models\CourseEnrollmentDetail;
use App\Models\Period;
use Illuminate\Http\Request;

class MyCourseMeetingEvaluationController extends Controller
{
    public function store(Request $request, $course_id)
    {
        $user = auth()->user();
        $period = Period::getActive()->first();

        $meeting = ClassMeeting::find($request->meeting_id);
        if ($meeting == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Meeting data not found',
            ], 404);
        }
        $enrollment = CourseEnrollment::where('student_id', $user->id)
            ->where('period_id', $period->id)
            ->first();

        if ($enrollment == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Meeting data not found',
            ], 404);
        }
        $enrollment_detail = CourseEnrollmentDetail::where('course_enrollment_id', $enrollment->id)
            ->where('class_id', $meeting->class_id)
            ->first();

        if ($enrollment_detail == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Meeting data not found',
            ], 404);
        }

        $evaluation = ClassAttendance::where('class_meeting_id', $meeting->id)
            ->where('course_enrollment_detail_id', $enrollment_detail->id)
            ->first();

        if ($evaluation == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Meeting data not found',
            ], 404);
        }
        $evaluation->rating = $request->rating;
        $evaluation->feedback = $request->feedback;
        $evaluation->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Evaluation saved successfully',
            'evaluation' => $evaluation,
        ]);
    }

    public function update(Request $request, $course_id, $meeting_id)
    {
        $meeting = ClassMeeting::find($meeting_id);
        if ($meeting == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Meeting data not found',
            ], 404);
        }

        $evaluation = ClassAttendance::where('class_meeting_id', $meeting->id)
            ->where('class_meeting_id', $meeting_id)
            ->first();

        if ($evaluation == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Meeting data not found',
            ], 404);
        }
        $evaluation->rating = $request->rating;
        $evaluation->feedback = $request->feedback;
        $evaluation->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Evaluation saved successfully',
            'evaluation' => $evaluation,
        ]);

    }
}
